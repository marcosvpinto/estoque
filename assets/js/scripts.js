$(document).ready(function(){ 
		$("table").dataTable( {
		"iDisplayLength": 100,
		"bAutoWidth": true,
		"sPaginationType": "bootstrap"
		/*"aoColumns": [
			null,
			null,
			{ "sType": "date-eu" }
		]*/
	} );
}); 

$(function(){
	$("input, textarea, select").tooltip({'placement':'right', 'trigger':'focus'});
});

jQuery(function($){
   $(".cnpj").mask("99.999.999-9999/99");
   $(".telefone").mask("(99) 9999-9999");
   $(".data_nota").mask("99/99/9999");
});

$(function() {
	$("#data_nota").datepicker();
});

/*
	Script para o data table integrar a paginacao com o estilo do bootstrap
*/
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
    return {
        "iStart":         oSettings._iDisplayStart,
        "iEnd":           oSettings.fnDisplayEnd(),
        "iLength":        oSettings._iDisplayLength,
        "iTotal":         oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage":          oSettings._iDisplayLength === -1 ?
            0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
        "iTotalPages":    oSettings._iDisplayLength === -1 ?
            0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
    };
}
 
/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function( oSettings, nPaging, fnDraw ) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function ( e ) {
                e.preventDefault();
                if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                    fnDraw( oSettings );
                }
            };
 
            $(nPaging).addClass('pagination').append(
                '<ul>'+
                    '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
                    '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
                '</ul>'
            );
            var els = $('a', nPaging);
            $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
            $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
        },
 
        "fnUpdate": function ( oSettings, fnDraw ) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);
 
            if ( oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            }
            else if ( oPaging.iPage <= iHalf ) {
                iStart = 1;
                iEnd = iListLength;
            } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }
 
            for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                // Remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();
 
                // Add the new list items and their event handlers
                for ( j=iStart ; j<=iEnd ; j++ ) {
                    sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                    $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                        .insertBefore( $('li:last', an[i])[0] )
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                            fnDraw( oSettings );
                        } );
                }
 
                // Add / remove disabled classes from the static elements
                if ( oPaging.iPage === 0 ) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }
 
                if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
} );



/*
	Script para o data table ganhar efeito de scroll vertical ao paginar
*/

/* Time between each scrolling frame */
$.fn.dataTableExt.oPagination.iTweenTime = 100;
  
$.fn.dataTableExt.oPagination.scrolling = {
    "fnInit": function ( oSettings, nPaging, fnCallbackDraw )
    {
        var oLang = oSettings.oLanguage.oPaginate;
        var oClasses = oSettings.oClasses;
        var fnClickHandler = function ( e ) {
            if ( oSettings.oApi._fnPageChange( oSettings, e.data.action ) )
            {
                fnCallbackDraw( oSettings );
            }
        };
  
        var sAppend = (!oSettings.bJUI) ?
            '<a class="'+oSettings.oClasses.sPagePrevDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button">'+oLang.sPrevious+'</a>'+
            '<a class="'+oSettings.oClasses.sPageNextDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button">'+oLang.sNext+'</a>'
            :
            '<a class="'+oSettings.oClasses.sPagePrevDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button"><span class="'+oSettings.oClasses.sPageJUIPrev+'"></span></a>'+
            '<a class="'+oSettings.oClasses.sPageNextDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button"><span class="'+oSettings.oClasses.sPageJUINext+'"></span></a>';
        $(nPaging).append( sAppend );
          
        var els = $('a', nPaging);
        var nPrevious = els[0],
            nNext = els[1];
          
        oSettings.oApi._fnBindAction( nPrevious, {action: "previous"}, function() {
            /* Disallow paging event during a current paging event */
            if ( typeof oSettings.iPagingLoopStart != 'undefined' && oSettings.iPagingLoopStart != -1 )
            {
                return;
            }
              
            oSettings.iPagingLoopStart = oSettings._iDisplayStart;
            oSettings.iPagingEnd = oSettings._iDisplayStart - oSettings._iDisplayLength;
              
            /* Correct for underrun */
            if ( oSettings.iPagingEnd < 0 )
            {
              oSettings.iPagingEnd = 0;
            }
              
            var iTween = $.fn.dataTableExt.oPagination.iTweenTime;
            var innerLoop = function () {
                if ( oSettings.iPagingLoopStart > oSettings.iPagingEnd ) {
                    oSettings.iPagingLoopStart--;
                    oSettings._iDisplayStart = oSettings.iPagingLoopStart;
                    fnCallbackDraw( oSettings );
                    setTimeout( function() { innerLoop(); }, iTween );
                } else {
                    oSettings.iPagingLoopStart = -1;
                }
            };
            innerLoop();
        } );
  
        oSettings.oApi._fnBindAction( nNext, {action: "next"}, function() {
            /* Disallow paging event during a current paging event */
            if ( typeof oSettings.iPagingLoopStart != 'undefined' && oSettings.iPagingLoopStart != -1 )
            {
                return;
            }
              
            oSettings.iPagingLoopStart = oSettings._iDisplayStart;
              
            /* Make sure we are not over running the display array */
            if ( oSettings._iDisplayStart + oSettings._iDisplayLength < oSettings.fnRecordsDisplay() )
            {
                oSettings.iPagingEnd = oSettings._iDisplayStart + oSettings._iDisplayLength;
            }
              
            var iTween = $.fn.dataTableExt.oPagination.iTweenTime;
            var innerLoop = function () {
                if ( oSettings.iPagingLoopStart < oSettings.iPagingEnd ) {
                    oSettings.iPagingLoopStart++;
                    oSettings._iDisplayStart = oSettings.iPagingLoopStart;
                    fnCallbackDraw( oSettings );
                    setTimeout( function() { innerLoop(); }, iTween );
                } else {
                    oSettings.iPagingLoopStart = -1;
                }
            };
            innerLoop();
        } );
    },
      
    "fnUpdate": function ( oSettings, fnCallbackDraw )
    {
        if ( !oSettings.aanFeatures.p )
        {
            return;
        }
          
        /* Loop over each instance of the pager */
        var an = oSettings.aanFeatures.p;
        for ( var i=0, iLen=an.length ; i<iLen ; i++ )
        {
            if ( an[i].childNodes.length !== 0 )
            {
                an[i].childNodes[0].className =
                    ( oSettings._iDisplayStart === 0 ) ?
                    oSettings.oClasses.sPagePrevDisabled : oSettings.oClasses.sPagePrevEnabled;
                  
                an[i].childNodes[1].className =
                    ( oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay() ) ?
                    oSettings.oClasses.sPageNextDisabled : oSettings.oClasses.sPageNextEnabled;
            }
        }
    }
};

/* Script para corrigir a ordenação por data do Data Table */
jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-eu-pre": function ( date ) {
        var date = date.replace(" ", "");
          
        if (date.indexOf('.') > 0) {
            /*date a, format dd.mn.(yyyy) ; (year is optional)*/
            var eu_date = date.split('.');
        } else {
            /*date a, format dd/mn/(yyyy) ; (year is optional)*/
            var eu_date = date.split('/');
        }
          
        /*year (optional)*/
        if (eu_date[2]) {
            var year = eu_date[2];
        } else {
            var year = 0;
        }
          
        /*month*/
        var month = eu_date[1];
        if (month.length == 1) {
            month = 0+month;
        }
          
        /*day*/
        var day = eu_date[0];
        if (day.length == 1) {
            day = 0+day;
        }
          
        return (year + month + day) * 1;
    },
 
    "date-eu-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
 
    "date-eu-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );
