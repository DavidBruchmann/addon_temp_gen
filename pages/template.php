<?php

/** @var rex_addon $this */


  $search = array("***name***","***version***","***author***","***title***","***release***");
  $replace = array($this->getConfig('a_name'),$this->getConfig('a_version'),$this->getConfig('a_author'),$this->getConfig('a_title'),$this->getConfig('a_release'));if (rex_post ( 'config-submit', 'boolean' )) {
  $this->setConfig ( rex_post ( 'config', [ 
      [ 
          'a_title',
          'string' 
      ],
      [ 
          'a_name',
          'string' 
      ],
      [ 
          'a_author',
          'string' 
      ],
      [ 
          'a_version',
          'string' 
      ],
      [ 
          'a_release',
          'string' 
      ],
      [ 
          'a_boot',
          'bool' 
      ],
      [ 
          'a_help',
          'bool' 
      ],
      [ 
          'a_install_php',
          'bool' 
      ],
      [ 
          'a_install_sql',
          'bool' 
      ],
      [ 
          'a_uninstall_sql',
          'bool' 
      ],
      [ 
          'a_lang',
          'bool' 
      ],
      [ 
          'a_pages',
          'bool' 
      ],
      [ 
          'a_lib',
          'bool' 
      ],
      [ 
          'a_vendor',
          'bool' 
      ],
      [ 
          'a_functions',
          'bool' 
      ],
      [ 
          'a_module',
          'bool' 
      ],
      [ 
          'a_templates',
          'bool' 
      ],
      [ 
          'a_assets',
          'bool' 
      ],
      [ 
          'a_data',
          'bool' 
      ],
      [ 
          'a_scss',
          'bool' 
      ],
      [ 
          'a_install',
          'bool' 
      ],
      [ 
          'a_plugins',
          'bool' 
      ] 
  ] ) );
  
  
  if ($this->getConfig ('a_name')) {
    echo rex_view::success ( $this->i18n ( 'template_saved' ) );
    $content = '<h3>Addon-Name: <b><i>'.$this->getConfig ('a_name').'</i></b><br></h3>
        <h3>Titel: <b><i>'.$this->getConfig ('a_title').'</i></b><br></h3>
        <h3>Author: <b><i>'.$this->getConfig ('a_author').'</i></b><br></h3>
        <h3>Version: <b><i>'.$this->getConfig ('a_version').'</i></b><br></h3>
        <h3>REDAXO Version: <b><i>'.$this->getConfig ('a_release').'</i></b><br></h3>
        Folgende Dateien werden bereitgestellt:<br><b><i>package.yml</b></i><br>';
    $content .=  ($this->getConfig ( 'a_boot' )?"<b><i>boot.php</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_help' )?"<b><i>help.php</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_install_php' )?"<b><i>install.php</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_install_sql' )?"<b><i>install.sql</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_uninstall_sql' )?"<b><i>uninstall.sql</b></i><br>":"");
    $content .= '<br>Folgende Verzeichnisse werden angelegt:<br>';
    $content .=  ($this->getConfig ( 'a_lang' )?"<b><i>lang</b> mit <b>de_de.lang</b> und <b>en_gb.lang</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_pages' )?"<b><i>pages</b> mit <b>index.php</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_lib' )?"<b><i>lib</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_vendor' )?"<b><i>vendor</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_functions' )?"<b><i>functions</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_module' )?"<b><i>module</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_templates' )?"<b><i>templates</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_assets' )?"<b><i>assets</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_data' )?"<b><i>data</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_scss' )?"<b><i>scss</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_install' )?"<b><i>install</b></i><br>":"");
    $content .=  ($this->getConfig ( 'a_plugins' )?"<b><i>plugins</b></i><br>":"");
    $formElements = [ ];
    
    $n = [ ];
    $n ['field'] = '<button class="btn btn-cancel rex-form-aligned" type="submit" name="config-cancel" value="1" ' . rex::getAccesskey ( $this->i18n ( 'template_cancel' ), 'save' ) . '>' . $this->i18n ( 'template_cancel' ) . '</button>';
    $formElements [] = $n;
    
    $n = [ ];
    $n ['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="config-create" value="1" ' . rex::getAccesskey ( $this->i18n ( 'template_create' ), 'save' ) . '>' . $this->i18n ( 'template_create' ) . '</button>';
    $formElements [] = $n;
    
    $fragment = new rex_fragment ();
    $fragment->setVar ( 'flush', true );
    $fragment->setVar ( 'elements', $formElements, false );
    $buttons = $fragment->parse ( 'core/form/submit.php' );
    
    $fragment = new rex_fragment ();
    $fragment->setVar ( 'class', 'edit' );
    $fragment->setVar ( 'title', 'Addon' );
    $fragment->setVar ( 'body', $content, false );
    $fragment->setVar ( 'buttons', $buttons, false );
    $content = $fragment->parse ( 'core/page/section.php' );
    
    echo '
    <form action="' . rex_url::currentBackendPage () . '" method="post">
        ' . $content . '
    </form>';
  } else {
    echo rex_view::warning ( $this->i18n ( 'template_name_missing' ) );
  }
} elseif (rex_post ( 'config-create', 'boolean' )) {

  echo rex_view::success ( $this->i18n ( 'template_created' ) );
  $newdir = str_replace($this->getProperty('package'),$this->getConfig('a_name'),$this->getPath());
  $source =$this->getDataPath()."package.yml";
  $destination =$newdir."package.yml";
  $yml = file_get_contents($source);
  $yml = str_replace($search,$replace,$yml);
  $pieces = array();
  if (@mkdir($newdir)) {
    $pieces[] = "<h3>neues Addon-Verzeichnis: <b>".$newdir."</b> wurde angelegt.</h3>";
    if (file_put_contents($destination, $yml)) {
      $pieces[] = "<b>Dateien:</b><i>";
      $pieces[] = "package.yml";
    }
    if ($this->getConfig ( 'a_boot' )) {
      $source =$this->getDataPath()."boot.php";
      $dest =$newdir."boot.php";
      if (copy($source, $dest)) {
        $pieces[] = "boot.php";
      }
    }
    if ($this->getConfig ( 'a_help' )) {
      $source =$this->getDataPath()."help.php";
      $dest =$newdir."help.php";
      if (copy($source, $dest)) {
        $pieces[] = "help.php";
      }
    }
    if ($this->getConfig ( 'a_install_php' )) {
      $source =$this->getDataPath()."install.php";
      $dest =$newdir."install.php";
      if (copy($source, $dest)) {
        $pieces[] = "install.php";
      }
    }
    if ($this->getConfig ( 'a_install_sql' )) {
      $source =$this->getDataPath()."install.sql";
      $dest =$newdir."install.sql";
      if (copy($source, $dest)) {
        $pieces[] = "install.sql";
      }
    }
    if ($this->getConfig ( 'a_uninstall_sql' )) {
      $source =$this->getDataPath()."uninstall.sql";
      $dest =$newdir."uninstall.sql";
      if (copy($source, $dest)) {
        $pieces[] = "uninstall.sql";
      }
    }
    $pieces[] = "<br></i><b>Verzeichnisse:</b><i>";
    if ($this->getConfig ( 'a_lang' )) {
      if (rex_dir::copy($this->getDataPath('lang'), $newdir."lang/")) {
        $de = $en = "";
        $filename = $newdir."lang/de_de.lang";
        if (replaceDummies($filename, $search, $replace)){
          $de = " - de_de.lang wurde aktualisiert";
        }
        $filename = $newdir."lang/en_gb.lang";
        if (replaceDummies($filename, $search, $replace)){
          $en = " - en_gb.lang wurde aktualisiert";
        }
          
        $pieces[] = "lang".$de.$en;
      }
    }
    if ($this->getConfig ( 'a_pages' )) {
      if (rex_dir::copy($this->getDataPath('pages'), $newdir."pages/")) {
        $de = "";
        $filename = $newdir."pages/index.php";
        if (replaceDummies($filename, $search, $replace)){
          $de = " - index.php wurde aktualisiert";
        }
        $pieces[] = "pages".$de;
      }
    }
    if ($this->getConfig ( 'a_lib' )) {
      if (rex_dir::copy($this->getDataPath('lib'), $newdir."lib/")) {
        $pieces[] = "lib";
      }
    }
    if ($this->getConfig ( 'a_vendor' )) {
      if (rex_dir::copy($this->getDataPath('vendor'), $newdir."vendor/")) {
        $pieces[] = "vendor";
      }
    }
    if ($this->getConfig ( 'a_functions' )) {
      if (rex_dir::copy($this->getDataPath('functions'), $newdir."functions/")) {
        $pieces[] = "functions";
      }
    }
    if ($this->getConfig ( 'a_module' )) {
      if (rex_dir::copy($this->getDataPath('module'), $newdir."module/")) {
        $pieces[] = "module";
      }
    }
    if ($this->getConfig ( 'a_templates' )) {
      if (rex_dir::copy($this->getDataPath('templates'), $newdir."templates/")) {
        $pieces[] = "templates";
      }
    }
    if ($this->getConfig ( 'a_assets' )) {
      if (rex_dir::copy($this->getDataPath('assets'), $newdir."assets/")) {
        $pieces[] = "assets";
      }
    }
    if ($this->getConfig ( 'a_data' )) {
      if (rex_dir::copy($this->getDataPath('data'), $newdir."data/")) {
        $pieces[] = "data";
      }
    }
    if ($this->getConfig ( 'a_scss' )) {
      if (rex_dir::copy($this->getDataPath('scss'), $newdir."scss/")) {
        $pieces[] = "scss";
      }
    }
    if ($this->getConfig ( 'a_install' )) {
      if (rex_dir::copy($this->getDataPath('install'), $newdir."install/")) {
        $pieces[] = "install";
      }
    }
    if ($this->getConfig ( 'a_plugins' )) {
      if (rex_dir::copy($this->getDataPath('plugins'), $newdir."plugins/")) {
        $pieces[] = "plugins";
      }
    }
  } else {
    if (is_dir($newdir)) {
      $pieces[] = "<h3>Das Verzeichnis ist bereits vorhanden!</h3>";
      $addon = $this->getConfig ('a_name');
      if(rex_addon::get($addon)->isAvailable()) {
        $pieces[] = "<h3>Das Addon ist installiert - bitte de-installieren und löschen</h3>";
      } else {
       $pieces[] = "<h3>Bitte über das Addon-Menü löschen.</h3>";
      }
    } else {
      $pieces[] = "<h3>Das Verzeichnis konnte nicht angelegt werden!</h3>";
    }
  }
  $pieces[] = "</i>";
  $content = join("<br>", $pieces);
  
  $fragment = new rex_fragment();
  $fragment->setVar('title', $this->i18n('template_info'));
  $fragment->setVar('body', $content, false);
  $content = $fragment->parse('core/page/section.php');
  
  echo $content;  
} else {
  
  $content = '<fieldset>';
  $formElements = [ ];
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-name"> Addon-Name</label>';
  $n ['field'] = '<input type="text" id="rex-template-name" name="config[a_name]" value="' . $this->getConfig ( 'a_name' ) . '" />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-title"> Addon-Titel</label>';
  $n ['field'] = '<input type="text" id="rex-template-title" name="config[a_title]" value="' . $this->getConfig ( 'a_title' ) . '" />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-author"> Author</label>';
  $n ['field'] = '<input type="text"  id="rex-template-author" name="config[a_author]" value="' . $this->getConfig ( 'a_author' ) . '" />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-version"> Version</label>';
  $n ['field'] = '<input type="text"  id="rex-template-version" name="config[a_version]" value="' . $this->getConfig ( 'a_version' ) . '" />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-release"> min. REDAXO Release</label>';
  $n ['field'] = '<input type="text"  id="rex-template-release" name="config[a_release]" value="' . $this->getConfig ( 'a_release' ) . '" />';
  $formElements [] = $n;
  
  $fragment = new rex_fragment ();
  $fragment->setVar ( 'elements', $formElements, false );
  $content .= $fragment->parse ( 'core/form/checkbox.php' );

  $fragment = new rex_fragment ();
  $fragment->setVar ( 'class', 'edit' );
  $fragment->setVar ( 'title', $this->i18n ( 'template_settings' ) );
  $fragment->setVar ( 'body', $content, false );
  $content0 = $fragment->parse ( 'core/page/section.php' );
  
  $content = '<fieldset>';
  
  $formElements = [ ];
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-boot">boot.php</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-boot" name="config[a_boot]" value="1" ' . ($this->getConfig ( 'a_boot' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-help">help.php</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-help" name="config[a_help]" value="1" ' . ($this->getConfig ( 'a_help' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-install_php">install.php</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-install_php" name="config[a_install_php]" value="1" ' . ($this->getConfig ( 'a_install_php' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-install_sql">install.sql</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-install_sql" name="config[a_install_sql]" value="1" ' . ($this->getConfig ( 'a_install_sql' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-uninstall_sql">uninstall.sql</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-uninstall_sql" name="config[a_uninstall_sql]" value="1" ' . ($this->getConfig ( 'a_uninstall_sql' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $fragment = new rex_fragment ();
  $fragment->setVar ( 'elements', $formElements, false );
  $content .= $fragment->parse ( 'core/form/checkbox.php' );
  
  $fragment = new rex_fragment ();
  $fragment->setVar ( 'class', 'edit' );
  $fragment->setVar ( 'title', $this->i18n ( 'template_files' ) );
  $fragment->setVar ( 'body', $content, false );
  $content1 = $fragment->parse ( 'core/page/section.php' );
  
  $content = '<fieldset>';
  
  $formElements = [ ];
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-lang">lang</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-lang" name="config[a_lang]" value="1" ' . ($this->getConfig ( 'a_lang' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-pages">pages</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-pages" name="config[a_pages]" value="1" ' . ($this->getConfig ( 'a_pages' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-lib">lib</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-lib" name="config[a_lib]" value="1" ' . ($this->getConfig ( 'a_lib' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-vendor">vendor</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-vendor" name="config[a_vendor]" value="1" ' . ($this->getConfig ( 'a_vendor' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-functions">functions</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-functions" name="config[a_functions]" value="1" ' . ($this->getConfig ( 'a_functions' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-module">module</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-module" name="config[a_module]" value="1" ' . ($this->getConfig ( 'a_module' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-templates">templates</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-templates" name="config[a_templates]" value="1" ' . ($this->getConfig ( 'a_templates' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-assets">assets</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-assets" name="config[a_assets]" value="1" ' . ($this->getConfig ( 'a_assets' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-data">data</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-data" name="config[a_data]" value="1" ' . ($this->getConfig ( 'a_data' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-scss">scss</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-scss" name="config[a_scss]" value="1" ' . ($this->getConfig ( 'a_scss' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-install">install</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-install" name="config[a_install]" value="1" ' . ($this->getConfig ( 'a_install' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $n = [ ];
  $n ['label'] = '<label for="rex-template-plugins">plugins</label>';
  $n ['field'] = '<input type="checkbox" id="rex-template-plugins" name="config[a_plugins]" value="1" ' . ($this->getConfig ( 'a_plugins' ) ? ' checked="checked"' : '') . ' />';
  $formElements [] = $n;
  
  $fragment = new rex_fragment ();
  $fragment->setVar ( 'elements', $formElements, false );
  $content .= $fragment->parse ( 'core/form/checkbox.php' );
  
  $formElements = [ ];
  
  $n = [ ];
  $n ['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="config-submit" value="1" ' . rex::getAccesskey ( $this->i18n ( 'template_continue' ), 'save' ) . '>' . $this->i18n ( 'template_continue' ) . '</button>';
  $formElements [] = $n;
  
  $fragment = new rex_fragment ();
  $fragment->setVar ( 'flush', true );
  $fragment->setVar ( 'elements', $formElements, false );
  $buttons = $fragment->parse ( 'core/form/submit.php' );
  
  $fragment = new rex_fragment ();
  $fragment->setVar ( 'class', 'edit' );
  $fragment->setVar ( 'title', $this->i18n ( 'template_folder' ) );
  $fragment->setVar ( 'body', $content, false );
  $fragment->setVar ( 'buttons', $buttons, false );
  $content2 = $fragment->parse ( 'core/page/section.php' );
  
  echo '
    <form action="' . rex_url::currentBackendPage () . '" method="post">
        ' . $content0 . $content1 . $content2 . '
    </form>';
}