(function($) {
   $(function() {
      $('#screenshot').load(function() {
         var
            appWidth = $(this).parent().width(),
            imgWidth = $(this).width(),
            appHeight = $(this).parent().height(),
            imgHeight = $(this).height();

         if(appHeight < imgHeight) {
            $(this).addClass('max-height');
         }
         if(appWidth < imgWidth) {
            $(this).addClass('max-width');
         }
      });
   });
}(jQuery));
