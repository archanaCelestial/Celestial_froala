<?php
 
require __DIR__ . '/vendor/froala/wysiwyg-editor-php-sdk/lib/FroalaEditor.php';
 
 
// Create upload folder if it does not exists.
$directoryName = __DIR__ . '/uploads';
if(!is_dir($directoryName)){
  mkdir($directoryName, 0755, true);
}
 
// Load Amazon S3 config from system environment variables.
$bucket = getenv('AWS_BUCKET');
$region = getenv('AWS_REGION');
$keyStart = getenv('AWS_KEY_START');
$acl = getenv('AWS_ACL');
$accessKeyId = getenv('AWS_ACCESS_KEY');
$secretKey = getenv('AWS_SECRET_ACCESS_KEY');
 
// Get hash.
$config = array(
  'timezone' => 'Europe/Bucharest',
  'bucket' => $bucket,
  'region' => $region,
  'keyStart' => $keyStart,
  'acl' => $acl,
  'accessKey' => $accessKeyId,
  'secretKey' => $secretKey
);
 
$hash = FroalaEditor_S3::getHash($config);
$hash = stripslashes(json_encode($hash));
 
?>
 
<!DOCTYPE html>
 
<html>
 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"./>
  <script src="./vendor/components/jquery/jquery.min.js"></script>
  <script src="https://static.filestackapi.com/filestack-js/3.32.0/filestack.min.js"></script>
  <script src="https://static.filestackapi.com/filestack-drag-and-drop-js/1.1.1/filestack-drag-and-drop.min.js"></script>
  <script src="https://static.filestackapi.com/transforms-ui/2.x.x/transforms.umd.min.js"></script>
<link rel="stylesheet" href="https://static.filestackapi.com/transforms-ui/2.x.x/transforms.css" />
  <!-- Include Font Awesome. -->
  <link href="./vendor/fortawesome/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
 
  <!-- Include Froala Editor styles -->
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/froala_editor.min.css" />
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/froala_style.min.css" />
 
  <!-- Include Froala Editor Plugins styles -->
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/char_counter.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/code_view.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/colors.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/emoticons.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/file.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/fullscreen.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/image_manager.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/image.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/line_breaker.css">
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/table.css">
  
  <link rel="stylesheet" href="./vendor/froala/wysiwyg-editor/css/plugins/froala_editor.pkgd.min.css">
 
  <!-- Include Froala Editor -->
  <script src="./vendor/froala/wysiwyg-editor/js/froala_editor.min.js"></script>
 
  <!-- Include Froala Editor Plugins -->
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/align.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/char_counter.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/code_beautifier.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/code_view.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/colors.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/emoticons.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/entities.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/file.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/font_family.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/font_size.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/fullscreen.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/image.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/image_manager.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/inline_style.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/line_breaker.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/link.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/lists.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/paragraph_format.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/paragraph_style.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/quote.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/save.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/table.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/video.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins.pkgd.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/track_changes.min.js"></script>  
   <script src="./vendor/froala/wysiwyg-editor/js/plugins/word_counter.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/word_paste.min.js"></script>
  
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/froala_editor.pkgd.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/filestack.min.js"></script>
  <script src="./vendor/froala/wysiwyg-editor/js/plugins/filestack-drag-and-drop.min.js"></script>
  
  <!-- End Froala -->
 
  <link rel="stylesheet" href="./app.css">
 
 
</head>
 
<body>
  <div class="sample">
    <h2>Sample 1: Save to disk</h2>
    <form>
      <textarea id="edit" name="content">
      
        </body>
    
      </textarea>
    </form>
    <div>
    <button id="button">Get HTML</button>
    <textarea id="textoutput"></textarea>
    </div>
   
  </div>
  <script>
    (function() {
      new FroalaEditor('#edit',{
        
  scaytCustomerId: '1:YjSV32-KWqTc2-AICoL3-WHiWO1-gYWRJ1-T1Cye3-Z9BJX3-YoRKY2-Icrlm-FMisd4-B26CZ3-SK3',
  imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption','filestackIcon','imageTUI'],
  // pluginsEnabled: ['filestack', 'align', 'charCounter', 'codeBeautifier', 'draggable', 'embedly', 'emoticons', 'entities', 'file', 'fontAwesome', 'fontFamily', 'fontSize', 'f:qlscreen', 'image', 'link', 'lists', 'paragraphFormat', 'paragraphStyle', 'quickInsert', 'quote', 'save', 'url', 'video', 'wordPaste', 'codeView', 'image', 'video'],
  pluginsEnabled: ['filestack', 'align', 'image', 'video',  'file', 'embedly', 'emoticons', 'insertFiles','imageTUI'],
 
 
  toolbarButtons: {
    'moreText': {
      'buttons': ['bold', 'italic', 'underline',
      'strikeThrough', 'subscript', 'superscript', 'fontFamily',
      'fontSize',  'textColor', 'backgroundColor', 'inlineClass',
      'inlineStyle', 'clearFormatting']
    },
 
    'moreParagraph': {
      'buttons': ['alignLeft', 'alignCenter',
      'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL',
      'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight',
      'outdent', 'indent', 'quote']
    },
 
    'moreRich': {
      'buttons': ['insertImage', 'insertVideo', 'openFilePicker', 'emoticons', 'insertLink',
      'embedly', 'insertHR', 'spellChecker', 'insertFile', 'insertFiles']
    },
  },
 
  filestackOptions: {
    uploadToFilestackOnly:false,
    filestackAPI: 'ASTv99CEKQBqNrblcN9FTz', // it working
 
    pickerOptions: {
      accept: [
             ".pdf",
             "image/jpeg",
             "image/png",
             "image/webp",
             "video/*",
             "audio/*"
      ],
      fromSources: [
             "local_file_system",
             "facebook"
      ]   
    },
    transformationOptions:{
      editor: {
        filters: {
          enabled: [
            'blackWhite',
            'sepia'
          ],
        },
        adjustments:{
          enabled:[
            "brightness",
            "noise"
          ]
        }
      }
    },
  },
  
  // filestackOptions: true,
  scaytAutoload: true,
 
        filestackOptions: {
    filestackAPI: 'ASTv99CEKQBqNrblcN9FTz',
  uploadToFilestackOnly: false,
// it working
    pickerOptions: {
      maxFiles: 3,
      accept: [
        ".pdf",
        "image/jpeg",
        "image/png",
        "image/webp",
        "video/*",
        "audio/*"
      ],
    },
  },
        
        
      
        
        imageUploadURL: './upload_image.php',
        imageUploadParams: {
          id: 'my_editor'
        },
 
        videoUploadURL: './upload_video.php',
        videoUploadParams: {
          id: 'my_editor'
        },
        
        fileUploadURL: './upload_file.php',
        fileUploadParams: {
          id: 'my_editor'
        },
 
        imageManagerLoadURL: './load_images.php',
        imageManagerDeleteURL: "./delete_image.php",
        imageManagerDeleteMethod: "POST",
        toolbarInline:false,
        iframe:true,
        keepTextFormatOnTable: true,
        keepFormatOnDelete: true,
       //wordCounterCount: false,
        height: 300,
  
        fontSizeDefaultSelection: '24',
        fontFamilyDefaultSelection: "Impact",
        useClasses: true,
        //preserveTabSpaces: true,
        //pluginsEnabled: ['track_changes'],
        
        
 
 
      events : {
        
      'video.removed': function ($video) {
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_video.php",
 
          // Request params.
          data: {
            src: $video.attr('src')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('video was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('video delete problem: ' + JSON.stringify(err));
        })
      },
      // Catch image removal from the editor.
      'image.removed': function ($img) {
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_image.php",
 
          // Request params.
          data: {
            src: $img.attr('src')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('image was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('image delete problem: ' + JSON.stringify(err));
        })
      },
 
      // Catch image removal from the editor.
      'file.unlink': function (link) {
 
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_file.php",
 
          // Request params.
          data: {
            src: link.getAttribute('href')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('file was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('file delete problem: ' + JSON.stringify(err));
        })
      }
    }
  })
})();
  </script>
 
  <div class="sample">
    <h2>Sample 2: Save to disk (resize on server)</h2>
    <form>
      <textarea id="edit-resize" name="content"></textarea>
    </form>
  </div>
  <script>
    (function() {
      new FroalaEditor('#edit-resize',{
 
        imageUploadURL: './upload_image_resize.php',
        imageUploadParams: {
          id: 'my_editor'
        },
 
        fileUploadURL: './upload_file.php',
        fileUploadParams: {
          id: 'my_editor'
        },
 
        imageManagerLoadURL: './load_images.php',
        imageManagerDeleteURL: "./delete_image.php",
        imageManagerDeleteMethod: "POST",
      events : {
      // Catch image removal from the editor.
      'image.removed': function ($img) {
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_image.php",
 
          // Request params.
          data: {
            src: $img.attr('src')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('image was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('image delete problem: ' + JSON.stringify(err));
        })
      },
 
      // Catch image removal from the editor.
      'file.unlink': function (link) {
 
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_file.php",
 
          // Request params.
          data: {
            src: link.getAttribute('href')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('file was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('file delete problem: ' + JSON.stringify(err));
        })
      }
    }
  })
})();
  </script>
 
    <div class="sample">
    <h2>Sample 3: Save to disk with custom validation: Images must be squares (width == height). Files must not exceed 10M.</h2>
    <form>
      <textarea id="edit-validation" name="content"></textarea>
    </form>
  </div>
  <script>
    (function() {
      new FroalaEditor('#edit-validation',{
 
        imageUploadURL: './upload_image_validation.php',
        imageUploadParams: {
          id: 'my_editor'
        },
        imageUploadParam: 'myImage',
 
        fileUploadURL: './upload_file_validation.php',
        fileUploadParams: {
          id: 'my_editor'
        },
        fileUploadParam: 'myFile',
        fileMaxSize: 1024 * 1024 * 50,
 
        imageManagerLoadURL: './load_images.php',
        imageManagerDeleteURL: "./delete_image.php",
        imageManagerDeleteMethod: "POST",
      events :{
      // Catch image removal from the editor.
      'image.removed': function ($img) {
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_image.php",
 
          // Request params.
          data: {
            src: $img.attr('src')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('image was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('image delete problem: ' + JSON.stringify(err));
        })
      },
 
      // Catch image removal from the editor.
      'file.unlink': function (link) {
 
        $.ajax({
          // Request method.
          method: "POST",
 
          // Request URL.
          url: "./delete_file.php",
 
          // Request params.
          data: {
            src: link.getAttribute('href')
          }
        })
        .done (function (data) {
          if(data=='"Success"'){
            console.log ('file was deleted');  
          } else {
            console.log('could not access the path');
          }
        })
        .fail (function (err) {
          console.log ('file delete problem: ' + JSON.stringify(err));
        })
      }
    }
  })
})();
  </script>
 
  <div class="sample">
    <h2>Sample 4: Save to Amazon using signature version 4</h2>
    <form>
      <textarea id="edit-amazon" name="content"></textarea>
    </form>
  </div>
 
  <script>
    (function() {
      new FroalaEditor('#edit-amazon',{
          imageUploadToS3: JSON.parse('<?php echo $hash; ?>'),
          fileUploadToS3: JSON.parse('<?php echo $hash; ?>'),
          videoUploadToS3: JSON.parse('<?php echo $hash; ?>')
      });
 
    })();
  </script>
</body>
 
</html>