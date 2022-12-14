
<div>
    
    <div class="col-xl-3 col-md-4 m-b-md">
        <div class="card border-left-success shadow h-100 p-t-sm no-underline">
            <div class="card-body">
                <div class="row-flex m-x-0 align-items-center">
                    <div class="col m-r-sm">
                        <div class="text-xs font-weight-bold text-success text-uppercase m-b-sm">
                            <?= _l('Languages in application') ?>
                        </div>
                        <div class="h2 m-b-0 m-t-sm font-weight-bold text-gray-800"><?php $translations = array_merge( [Lang::LANG_DEFAULT], Lang::searchForTranslationFiles() ); echo strtoupper(join(', ' , $translations )); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa text-gray-300 fa-2x fa-flag-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-4 m-b-md">
        <div class="card border-left-success shadow h-100 p-t-sm no-underline">
            <div class="card-body">
                <div class="row-flex m-x-0 align-items-center">
                    <div class="col m-r-sm">
                        <div class="text-xs font-weight-bold text-success text-uppercase m-b-sm">
                            <?= _l('Missing translations') ?>
                        </div>
                        <div class="h2 m-b-0 m-t-sm font-weight-bold text-gray-800"><?= count( Lang::getMissingTranslations() ) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa text-gray-300 fa-2x fa-flag-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-4 m-b-md">
        <div class="card border-left-warning shadow h-100 p-t-sm no-underline">
            <div class="card-body">
                <div class="row-flex m-x-0 align-items-center">
                    <div class="col m-r-sm">
                        <div class="text-xs font-weight-bold text-warning text-uppercase m-b-sm">
                            <?= _l('Last migration file') ?>
                        </div>
                        <div class="h2 m-b-0 m-t-sm font-weight-bold text-gray-800"><?php $last_db_migration = Settings::getLastDbMigrationFile(); echo $last_db_migration->name; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa text-gray-300 fa-2x fa-database" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>