
@setup
    include(__DIR__ . '/resources/envoy/setup.php');
@endsetup

@servers(['web' => $deployConnection ])

@story('deploy')
    artisan-down
    git-clone
    compose
    update-symlinks
    npm
    migrate-release
    cache
    restart-queues
    test
    reload-fpm
    artisan-up
@endstory

@task('artisan-up')
    if [ -f {{ $baseDir }}/artisan ]; then
        php {{ $baseDir }}/artisan up
    fi
@endtask

@task('artisan-down')
    if [ -f {{ $baseDir }}/artisan ]; then
        php {{ $baseDir }}/artisan down
    fi
@endtask

@task('git-clone')
    mkdir -p {{ $releaseDir }}
    cd {{ $releaseDir }}
    git clone {{ $gitRepository }} --branch={{ $branch ?? $gitBranch }} --depth=1 -q {{ $releaseDir }}
    sudo chown -R $USER:www-data {{ $releaseDir }}
    sudo chmod -R 775 {{ $releaseDir }}
@endtask

@task('compose')
    cd {{ $releaseDir }}
    composer update --quiet --prefer-dist --optimize-autoloader
    composer install --no-interaction --quiet --prefer-dist --optimize-autoloader
@endtask

@task('npm')
    cd {{ $releaseDir }}
    npm install --silent --no-progress > /dev/null
    npm run prod --silent --no-progress > /dev/null
    rm -rf node_modules
@endtask

@task('update-symlinks')
    rm -rf {{ $releaseDir }}/storage
    ln -nfs {{ $baseDir }}/storage {{ $releaseDir }}/storage
    ln -nfs {{ $baseDir }}/.env {{ $releaseDir }}/.env
    ln -nfs {{ $releaseDir }} {{ $baseDir }}/current
@endtask

@task('migrate-release')
    php {{ $releaseDir }}/artisan migrate --force
@endtask

@task('migrate-rollback')
    php {{ $releaseDir }}/artisan migrate:rollback --force
@endtask

@task('reload-fpm')
    service php8.0-fpm reload
@endtask

@task('test')
    php {{ $releaseDir }}/artisan test
@endtask

@task('cache')
    php {{ $baseDir }}/current/artisan route:cache
    php {{ $baseDir }}/current/artisan config:cache
    php {{ $baseDir }}/current/artisan view:cache
@endtask

@task('restart-queues')
    php {{ $baseDir }}/current/artisan queue:restart
@endtask

@error
    @slack($slackWebHook, $slackChannel)
    @telegram($tgBotToken, $tgChatId)
@enderror

