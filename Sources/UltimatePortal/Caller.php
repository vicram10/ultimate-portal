<?php

namespace UltimatePortal;

class Caller {
    function __construct(){
        global $sourcedir;
        require_once($sourcedir . '/UltimatePortal/CoreBase.php');
        foreach (CoreBase::filesAutoLoad as $file) {
            require_once($sourcedir . '/UltimatePortal/' . $file);
        }
        
        //models autoload
        foreach(scandir($sourcedir.'/UltimatePortal/Models') as $filename){
            if (is_dir($filename)) continue;
            require_once($sourcedir.'/UltimatePortal/Models/'.$filename);
        }
    }

    function subs(): Subs { return new Subs(); }

    function load(): Load { return new Load(); }

    function subsBlock(): SubsBlocks { return new SubsBlocks(); }

    function subsUtils(): SubsUtils { return new SubsUtils(); }

    function ssi(): SSI { return new SSI(); }
}
