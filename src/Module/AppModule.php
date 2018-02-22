<?php
namespace KSeta\CarCatalog\Module;

use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use josegonzalez\Dotenv\Loader as Dotenv;
use KSeta\CarCatalog\Annotation\BenchMark;
use KSeta\CarCatalog\Interceptor\BenchMarker;
use Psr\Log\LoggerInterface;
use Ray\CakeDbModule\CakeDbModule;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = dirname(__DIR__, 2);
        Dotenv::load([
            'filepath' => $appDir . '/.env',
            'toEnv' => true
        ]);
        $this->install(new AuraRouterModule($appDir . '/var/conf/aura.route.php'));
        $this->install(new PackageModule);
        $this->bind(LoggerInterface::class)->toProvider(MonologLoggerProvider::class)->in(Scope::SINGLETON);

        $this->bindInterceptor(
            $this->matcher->any(),                           // どのクラスでも
            $this->matcher->annotatedWith(BenchMark::class), // @BenchMarkとアノテートされているメソッドに
            [BenchMarker::class]                             // BenchMarkerインターセプターを適用
        );

        $dbConfig = [
            'driver' => 'Cake\Database\Driver\Sqlite',
            'database' => $appDir . '/var/db/todo.sqlite3'
        ];
        $this->install(new CakeDbModule($dbConfig));
    }
}
