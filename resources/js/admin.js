// Assuming you use e.g. webpack which can load UMD modules by using ES6 syntax.
import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';

require('./app');

require('./upload');

require('./themes/main');

if (document.querySelector('#editor')) {
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            ckfinder: {
                uploadUrl: '/superuseradminlacj5ub3lqwysaj9rik5/upload-ckeditor-images?_token='+$('meta[name="csrf-token"]').attr('content'),
            }
        } )
        .then( editor => {
        } )
        .catch( error => {
            console.error( error.stack );
        } );
}