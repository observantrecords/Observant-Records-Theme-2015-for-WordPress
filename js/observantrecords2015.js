/**
 * Created by gbueno on 12/19/2014.
 */
var facebox_options = {
    closeImage: 'http://cdn.observantrecords.com/web/images/closelabel.gif',
    loadingImage: 'http://cdn.observantrecords.com/web/images/loading.gif'
};
(function ($) {
    $(function () {
        $('a[rel*=facebox]').facebox(facebox_options);
    });
})(jQuery);
