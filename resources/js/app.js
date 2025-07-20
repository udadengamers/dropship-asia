require('./bootstrap');
import swal from 'sweetalert';
const Swal = require('sweetalert2')
window.swal = swal;
// import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import 'jquery-ui/ui/widgets/datepicker.js';

try {
    window.axios = require('axios').default;
    require('bootstrap');
    window.$ = window.jQuery = require("jquery");

    require('datatables.net-bs4');

    $('.datepicker').datepicker({step:30});

} catch (error) {

}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
