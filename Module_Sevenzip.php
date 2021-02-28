<?php
namespace GDO\Sevenzip;

use GDO\Core\GDO_Module;
use GDO\File\GDT_Path;
use GDO\Util\Process;

/**
 * 7zip wrapper.
 * Stores 7zip executable path.
 * Includes Archive7z files withour composer.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class Module_Sevenzip extends GDO_Module
{
    ###########
    ### Lib ###
    ###########
    public function include7ZIP()
    {
        $path = $this->filePath('Archive7z/src');
        require_once $path . '/Exception.php';
        require_once $path . '/Entry.php';
        require_once $path . '/Archive7zTrait.php';
        require_once $path . '/Archive7z.php';
        require_once $path . '/Parser.php';
    }
    
    ##############
    ### Config ###
    ##############
    public function getConfig()
    {
        return [
            GDT_Path::make('7zip_path')->existingFile()->initial('7zip'),
        ];
    }
    
    public function cfgPath() { return $this->getConfigVar('7zip_path'); }
    
    ###############
    ### Install ###
    ###############
    public function onInstall()
    {
        if ($path = Process::commandPath('7zip'))
        {
            $this->saveConfigVar('7zip_path', $path);
        }
    }
    
}
