<?php

/*
 * This file is part of the PHP CS utility.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\CS\Finder;

/**
 * @author Peter Drake <pdrake@gmail.com>
 */
class DrupalFinder extends DefaultFinder
{
    public function __construct()
    {
        parent::__construct();

        $this
            ->files()
            ->name('*.php')
            ->name('*.module')
            ->name('*.inc')
            ->name('*.install')
            ->name('*.theme')
            ->name('*.profile')
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->exclude(
                array(
                  'libraries',
                  '*default.inc*',
                  '*jquery*',
                  '*panelizer.inc*',
                  '*.features.*',
                  '*.min.js*',
                  '*strongarm.inc*',
                  '*App.js*',
                  '*getid3*',
                  '*phpseclib*',
                  '*fpdf16*',
                  'rml_tracked_return_retailer/classes/proxy*',
                )
            )
        ;
    }

    public function setDir($dir)
    {
        $this->in($this->getDirs($dir));
    }

    /**
     * Gets the directories that needs to be scanned for files to validate.
     *
     * @return array
     */
    protected function getDirs($dir)
    {
        return array($dir);
    }

    /**
     * Excludes files because modifying them would break.
     *
     * This is mainly useful for fixtures in unit tests.
     *
     * @return array
     */
    protected function getFilesToExclude()
    {
        return array();
    }
}
