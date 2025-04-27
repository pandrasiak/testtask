let $ = jQuery.noConflict();
import '../scss/style.scss';

console.log('Hello FOOZ!!!');

function fetchBooks(page = 1, $btn) {
 
    $.ajax({
        url: ajaxurl,
        type: 'GET',
        data: {
            action: 'get_books',
            paged: page, 
        },
        success: function(response) {
            if (response.success && Array.isArray(response.data)) {
                let books = response.data;
                let $booksList = $btn.parents('.js-load-more').find('.js-load-more__result'); 
                let $bookTemplate = $('.js-load-more__template'); 

                books.forEach(function(book) {
                    let newBook = document.importNode($bookTemplate[0].content, true); 
                    let bookHtml = newBook.firstElementChild.innerHTML;

                    bookHtml = bookHtml.replace('{{name}}', book.name);
                    bookHtml = bookHtml.replace('{{genre}}', book.genre);
                    bookHtml = bookHtml.replace('{{date}}', book.date);
                    bookHtml = bookHtml.replace('{{excerpt}}', book.excerpt);

                    $booksList.append(bookHtml);
                });

                let nextPage = page + 1;
                $btn.attr('data-next-page', nextPage);

            } else {
                console.log('Brak książek lub wystąpił błąd.');
            }
        },
        error: function() {
            console.log('Błąd zapytania AJAX');
        }
    });
}

$('.js-load-more__btn').click(function() {
    let nextPage = parseInt($(this).attr('data-next-page'));
    fetchBooks(nextPage, $(this)); 
});


