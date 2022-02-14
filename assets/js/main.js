;(function ($) {
    $(document).ready(function () {
        var App = {};

        App.init = function () {

            var $grid = $('.grid').isotope({
                itemSelector: '.recipe',
                percentPosition: true,
                layoutMode: 'fitRows',
                masonry: {
                    columnWidth: '.grid-sizer'
                },
                filter: '*'
            });

            $('.recipe-description-container textarea').css('overflow', 'hidden').autogrow({
                vertical: true,
                horizontal: false
            });

            $('.table-directions textarea').css('overflow', 'hidden').autogrow({vertical: true, horizontal: false});

            //2nd and 3rd level nav slide up/down animation
            $(document).ready(function () {
                $("li.dropdown, li.dropdown-submenu").hover(
                    function () {
                        $(this).children('.dropdown-menu').slideDown(150, stop());
                    },
                    function () {
                        $(this).children('.dropdown-menu').slideUp(150, stop());
                    }
                );
                function stop() {
                    $('.dropdown-menu').stop(true, true);
                }
            });

            // Get url parameter for DOM interaction
            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;
                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');
                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
            };

            // Add Recipe Status Alerts
            var add_status = getUrlParameter('add_status');
            if (add_status === 'success') {
                swal(
                    "Success!",
                    "Your recipe has been successfully added.",
                    "success"
                );
            }
            if (add_status === 'failed') {
                swal(
                    "Uh Oh!",
                    "Something went wrong. Your recipe was not successfuly added. Please try again.",
                    "error"
                );
            }

            // Add Recipe Status Alerts
            var edit_status = getUrlParameter('edit_status');
            if (edit_status === 'success') {
                swal(
                    "Success!",
                    "Your recipe has been successfully updated.",
                    "success"
                );
            }
            if (edit_status === 'failed') {
                swal(
                    "Uh Oh!",
                    "Something went wrong. Your recipe was not successfuly updated. Please try again.",
                    "error"
                );
            }



            function resetIngredientIndexes() {
                var j = 1;
                $('.individual-ingredient').each(function () {
                    if (j > 1) {
                        $(this).attr('id', j);
                        $(this).attr('class', 'individual-ingredient individual-ingredient-' + j);
                        $(this).find('.measurement-amount input').attr('name', 'ingredients['+ j +'][amount]');
                        $(this).find('.ingredient-item input').attr('name', 'ingredients['+ j +'][name]');
                        $(this).find('#measurement-types').attr('name', 'ingredients['+ j +'][measurement_type]');
                    }
                    j++;
                });
            }

            $(function () {
                var i = $('.individual-ingredient').size() + 1;

                $('.add-recipe .add-ingredient-button').on('click', function () {
                    i = $('.individual-ingredient').size() + 1;

                    $(".table-ingredients").append("" +
                        "<tr class='individual-ingredient individual-ingredient-" + i + "' id='" + i + "'> <td class='measurement-amount'> <input type='number' min='1' class='form-control' required='' name='ingredients["+ i +"][amount]'> </td> <td class='measurement-type-list'> <select class='form-control' id='measurement-types' name='ingredients["+ i +"][measurement_type]'> <option value='' disabled='' selected='' required='' hidden=''>Please select...</option> <option>none</option> <option>pound</option> <option>tablespoon</option> <option>teaspoon</option> <option>ounce</option> <option>cup</option> <option>liter</option> <option>gram</option> <option>kilogram</option> </select> </td> <td class='ingredient-item'> <input type='text' class='form-control' name='ingredients["+ i +"][name]'> </td> <td class='ingredient-delete'> <a class='add-recipe-delete-ingredient-btn'> <i class='fas fa-times-circle'></i> </a> </td> </tr>"
                    );

                    i++;
                    return false;
                });

                $('.table-ingredients').on('click', 'a', function () {
                    if (i >= 1) {
                        $(this).parents('.individual-ingredient').remove();
                        resetIngredientIndexes();
                    }
                    return false;
                });
            });


            function resetDirectionIndexes() {
                var j = 1;
                $('.individual-direction').each(function () {
                    if (j > 1) {
                        $(this).attr('id', j);
                        $(this).attr('class', 'individual-direction individual-direction-' + j);
                        $(this).find('.direction-number-icon').html(j)
                    }
                    j++;
                });
            }

            $(function () {
                var i = $('.individual-direction').size() + 1;

                $('.add-recipe .add-direction-button').on('click', function () {
                    i = $('.individual-direction').size() + 1;

                    $(".table-directions").append("<tr class='individual-direction individual-direction-" + i + "' id='" + i + "'>" +
                        "<td class='direction-number'>" +
                        "<div class='direction-number-icon'>" + i + "</div>" +
                        "</td>" +
                        "<td class='direction-text'>" +
                        "<textarea type='' class='form-control direction-text-textarea' placeholder='' name='direction[]'></textarea>" +
                        "</td>" +
                        "<td class='direction-delete'>" +
                        "<a class='add-recipe-delete-direction-btn'>" +
                        "<i class='fas fa-times-circle'></i>" +
                        "</a>" +
                        "</td>" +
                        "</tr>"
                    );

                    i++;
                    return false;
                });

                $('.table-directions').on('click', 'a', function () {
                    if (i >= 1) {
                        $(this).parents('.individual-direction').remove();
                        resetDirectionIndexes();
                    }
                    return false;
                });



            });

        };

        App.init();

    });

})(jQuery);