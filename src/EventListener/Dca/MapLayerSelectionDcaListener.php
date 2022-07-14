<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\EventListener\Dca;

use Contao\Backend;
use Contao\BackendTemplate;
use Contao\Input;
use Contao\StringUtil;
use Cowegis\Bundle\Contao\Model\Map\MapModel;
use Cowegis\Bundle\Contao\Model\Map\MapRepository;
use Doctrine\DBAL\Connection;
use Netzmacht\Contao\Toolkit\Dca\Listener\AbstractListener;
use Netzmacht\Contao\Toolkit\Dca\Manager;
use Netzmacht\Contao\Toolkit\Security\Csrf\CsrfTokenProvider;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class MapLayerSelectionDcaListener extends AbstractListener
{
    /** @var string */
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
    protected static $name = 'tl_cowegis_layer';

    private Connection $connection;

    private RouterInterface $router;

    private TranslatorInterface $translator;

    private MapRepository $mapRepository;

    private CsrfTokenProvider $csrfTokenProvider;

    public function __construct(
        Manager $dcaManager,
        MapRepository $mapRepository,
        Connection $connection,
        RouterInterface $router,
        TranslatorInterface $translator,
        CsrfTokenProvider $csrfTokenProvider
    ) {
        parent::__construct($dcaManager);

        $this->connection        = $connection;
        $this->router            = $router;
        $this->translator        = $translator;
        $this->mapRepository     = $mapRepository;
        $this->csrfTokenProvider = $csrfTokenProvider;
    }

    public function initializeMapView(): void
    {
        if (Input::get('do') !== 'cowegis_map') {
            return;
        }

        $mapModel = $this->mapRepository->find((int) Input::get('id'));
        if (! $mapModel instanceof MapModel) {
            throw new BadRequestHttpException();
        }

        $definition = $this->getDefinition();
        $definition->modify(
            ['config'],
            static function (array $config) {
                $config['closed']       = true;
                $config['notCopyable']  = true;
                $config['notCreatable'] = true;
                $config['notDeletable'] = true;
                $config['notEditable']  = true;
                $config['notSortable']  = true;

                return $config;
            }
        );

        $definition->set(
            ['list', 'global_operations'],
            [
                'back'        => [
                    'label' => [$mapModel->title, $this->translator->trans('MSC.backBT', [], 'contao_default')],
                    'href'  => 'table=tl_cowegis_map&id=',
                    'class' => 'header header_back',
                ],
                'toggleNodes' => $definition->get(['list', 'global_operations', 'toggleNodes']),
            ]
        );
        $definition->set(
            ['list', 'operations'],
            [
                'map' => [
                    'button_callback' => [self::class, 'mapIntegrationButtons'],
                ],
            ]
        );
    }

    /** @param array<string,mixed> $row */
    public function mapIntegrationButtons(array $row): string
    {
        $result = $this->connection->executeQuery(
            'SELECT * FROM tl_cowegis_map_layer WHERE pid=:mapId AND layerId=:layerId LIMIT 0,1',
            [
                'mapId'   => Input::get('id'),
                'layerId' => $row['id'],
            ]
        );

        $layer    = $result->fetchAssociative();
        $template = new BackendTemplate('be_cowegis_map_layer_actions');
        $template->setData(
            [
                'exists'                => $result->rowCount() > 0,
                'active'                => $layer['active'] ?? false,
                'action'                => $this->router->generate(
                    'cowegis_contao_backend_map_layer_actions',
                    [
                        'mapId'   => Input::get('id'),
                        'layerId' => $row['id'],
                    ],
                ),
                'editUrl'               => $result->rowCount() > 0
                    ? Backend::addToUrl('table=tl_cowegis_map_layer&amp;act=edit&amp;id=' . ($layer['id'] ?? ''))
                    : null,
                'editLabel'             => $this->translate('tl_cowegis_map_layer.edit.0'),
                'editTitle'             => $this->translate('tl_cowegis_map_layer.edit.1'),
                'initialVisible'        => (bool) ($layer['initialVisible'] ?? false),
                'activateLabel'         => $this->translate('tl_cowegis_map_layer.activate.0'),
                'activateTitle'         => $this->translate('tl_cowegis_map_layer.activate.1'),
                'disableLabel'          => $this->translate('tl_cowegis_map_layer.disable.0'),
                'disableTitle'          => $this->translate('tl_cowegis_map_layer.disable.1'),
                'toggleVisibilityLabel' => $this->translate('tl_cowegis_map_layer.toggleVisibility.0'),
                'toggleVisibilityTitle' => $this->translate('tl_cowegis_map_layer.toggleVisibility.1'),
                'requestToken'          => $this->csrfTokenProvider->getTokenValue(),
            ]
        );

        return $template->parse();
    }

    /** @param array<string,mixed> $params */
    private function translate(string $key, array $params = [], ?string $domain = null): string
    {
        $domain = $domain ?: 'contao_tl_cowegis_map_layer';

        return StringUtil::specialchars($this->translator->trans($key, $params, $domain));
    }
}
