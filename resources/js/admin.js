import './bootstrap';
// import 'laravel-datatables-vite';
import '@tabler/core';
import '@tabler/core/dist/libs/fslightbox/index';
import '@tabler/core/src/js/demo-theme.js';
import { Notyf } from 'notyf';
import Modal from 'bootstrap/js/dist/modal';
import TomSelect from 'tom-select';
import tinyMCE from 'tinymce';
import 'tinymce-i18n/langs/ar';
import 'tinymce/models/dom';
import 'tinymce/icons/default';
import 'tinymce/themes/silver/theme';
import 'tinymce/skins/ui/oxide/skin';
import 'tinymce/skins/ui/oxide-dark/skin';
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/code';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/media';
import 'tinymce/plugins/table';
import 'tinymce/plugins/code';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/directionality';

import Alpine from 'alpinejs';

window.notyf = new Notyf();
window.bsmodal = Modal;
window.TomSelect = TomSelect;
window.Alpine = Alpine;
Alpine.start();

window.initTinymce = function() {
    let options = {
        selector: '.tinymce-textarea',
        language: 'en',
        height: 300,
        menubar: false,
        statusbar: false,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code wordcount directionality',
        toolbar: 'undo redo | link formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | ltr rtl | table bullist numlist outdent indent | ' +
            'image media | removeformat fullscreen',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
        file_picker_callback(callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

            tinymce.activeEditor.windowManager.openUrl({
                url: '/file-manager/tinymce5',
                title: 'Laravel File manager',
                width: x * 0.8,
                height: y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content, { text: message.text })
                }
            })
        }
    }
    if (localStorage.getItem("tablerTheme") === 'dark') {
        options.skin = 'oxide-dark';
        options.content_css = 'dark';
    }
    tinyMCE.init(options);
};

(function($) {
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(json) {
                if (json.message)
                    notyf.success(json.message)
            },
            error: function(jqXHR) {
                var json = jqXHR.responseJSON;
                if (typeof json.errors != 'undefined' && json.errors.length) {
                    json.errors.array.forEach(err => {
                        notyf.error(err)
                    });
                } else {
                    notyf.error(json.message)
                }
            }
        });
    });
    if ($('.tinymce-textarea').length) {
        window.initTinymce();
    }
    $('body').on('change', '.img-input', function() {
        $(this).siblings('.img-input-preview')[0].src = URL.createObjectURL(this.files[0]);
    });
})(jQuery);
