/**
 * Created by Tj on 7/24/2016.
 */
$(document).ready(function () {
   
    

    // if (jQuery().iCheck) {
    //     $('.pcheck').iCheck({
    //         checkboxClass: 'icheckbox_square-blue',
    //         radioClass: 'iradio_square-blue',
    //         increaseArea: '20%' // optional
    //     });
    // }
    if (jQuery().wysihtml5) {
        $('.wysihtml5').wysihtml5({});
    }
    // if (jQuery().datepicker) {
    //     $('.date-picker').datepicker({
    //         orientation: "left",
    //         autoclose: true,input,
    //         format: "yyyy-mm-dd"
    //     });
    // $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    // }
    // $('.time-picker').datetimepicker({
    //     format: 'HH:mm'
    // });
    if (jQuery().TouchSpin) {
        $(".touchspin").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0,
            max: 10000000000,
            step: 0.01,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 1,
            prefix: ''
        });
    }
    // $('[data-toggle="confirmation"]').confirmation({
    //     popout: true
    // });
    // $('[data-toggle="tooltip"]').tooltip();
    var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        dropdowns.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    if (jQuery().select2) {
        $(".select2").select2({
            theme: "bootstrap"
        });
    }
    $(".fancybox").fancybox();
 
    tinyMCE.init({
        selector: ".tinymce",
        theme: "modern",
        plugins: [
            "advlist autolink link charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
            "table contextmenu directionality paste textcolor code jbimages"
        ],
        relative_urls: false,
        remove_script_host: false,
        convert_urls: false,
        browser_spellcheck: true,
        image_advtab: true,
        toolbar1: "bold italic underline | jbimages link | preview code  | easyColorPicker",
    });
    $(".numeric").numeric();
    $(".positive").numeric({negative: false});
    $(".positive-integer").numeric({decimal: false, negative: false});
    $(".decimal-2-places").numeric({decimalPlaces: 2});
    $(".decimal-4-places").numeric({decimalPlaces: 4});

});
// $(document).on("ajaxComplete", function () {
//     if (jQuery().iCheck) {
//         $('.pcheck').iCheck({
//             checkboxClass: 'icheckbox_square-blue',
//             radioClass: 'iradio_square-blue',
//             increaseArea: '20%' // optional
//         });
//     }
//     if (jQuery().wysihtml5) {
//         $('.wysihtml5').wysihtml5({});
//     }
//     if (jQuery().datepicker) {
//         $('.date-picker').datepicker({
//             orientation: "left",
//             autoclose: true,
//             format: "yyyy-mm-dd"
//         });
//         //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
//     }
//     $('.time-picker').datetimepicker({
//         format: 'HH:mm'
//     });
//     if (jQuery().TouchSpin) {
//         $(".touchspin").TouchSpin({
//             buttondown_class: 'btn blue',
//             buttonup_class: 'btn blue',
//             min: 0,
//             max: 10000000000,
//             step: 0.01,
//             decimals: 2,
//             boostat: 5,
//             maxboostedstep: 1,
//             prefix: ''
//         });
//     }
//     // $('[data-toggle="confirmation"]').confirmation({
//     //     popout: true
//     // });
//     // $('[data-toggle="tooltip"]').tooltip();
//     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
//     tooltipTriggerList.map(function (tooltipTriggerEl) {
//         return new bootstrap.Tooltip(tooltipTriggerEl);
//     });
//     if (jQuery().select2) {
//         $(".select2").select2({
//             theme: "bootstrap"
//         });
//     }
//     $(".fancybox").fancybox();
//     $('.delete').on('click', function (e) {
//         e.preventDefault();
//         var href = $(this).attr('href');
//         swal({
//             title: 'Are you sure?',
//             text: '',
//             type: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Ok',
//             cancelButtonText: 'Cancel'
//         }).then(function () {
//             window.location = href;
//         })
//     });


//     $(".numeric").numeric();
//     $(".positive").numeric({negative: false});
//     $(".positive-integer").numeric({decimal: false, negative: false});
//     $(".decimal-2-places").numeric({decimalPlaces: 2});
//     $(".decimal-4-places").numeric({decimalPlaces: 4});
// });

function isDecimalKey(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46 &&
        ((charCode != 65 && charCode != 86 && charCode != 67 && charCode != 99 && charCode != 120 && charCode != 118 && charCode != 97))) {
        alert("Only numbers or decimals are allowed");
        return false;
    }
    //1 decimal allowed
    if (number.length > 1 && charCode == 46) {
        return false;
    }

    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1) && (charCode > 31)) {
        return false;
    }
    return true;
}
function isInterestKey(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
        alert("Only numbers or decimals are allowed");
        return false;
    }
    //1 decimal allowed
    if (number.length > 1 && charCode == 46) {
        return false;
    }

    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if (caratPos > dotPos && dotPos > -1 && (number[1].length > 3) && (charCode > 31)) {
        return false;
    }
    return true;
}

function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 65 && charCode != 86 && charCode != 67 && charCode != 99 && charCode != 120 && charCode != 118 && charCode != 97)) {
        alert("Only numbers are allowed");
        return false;
    }
    return true;
}
