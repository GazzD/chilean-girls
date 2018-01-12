// Fixes MIME Laravel Validation
$.extend(true, laravelValidation, {
    methods:{
        Mimes: function(value, element, params) {
            var lowerParams = $.map(params, function(item, index) {
                return item.toLowerCase();
            });
            return (!window.File || !window.FileReader || !window.FileList || !window.Blob) ||
               lowerParams.indexOf(laravelValidation.helpers.fileinfo(element).extension.toLowerCase())!==-1;
        }
    }
});