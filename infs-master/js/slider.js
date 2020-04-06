/* SLIDER */
var slider_img = $('.side-articles article:nth-of-type('+ 1 +') img').attr('src');
var slider_a = $('.side-articles article:nth-of-type('+ 1 +') a').text();
var slider_href = $('.side-articles article:nth-of-type('+ 1 +') a').attr('href');
var slider_p = $('.side-articles article:nth-of-type('+ 1 +') p').text();

$("#slider-img").attr('src', slider_img);
$("#slider-a").text(slider_a);
$("#slider-a").attr('href', slider_href);
$("#slider-p").text(slider_p);

var i = 1;
function next_post() {
  if (i > 5) i = 1;

  slider_img = $('.side-articles article:nth-of-type('+ i +') img').attr('src');
  slider_a = $('.side-articles article:nth-of-type('+ i +') a').text();
  slider_href = $('.side-articles article:nth-of-type('+ i +') a').attr('href');
  slider_p = $('.side-articles article:nth-of-type('+ i +') .article-info').text();

  $("#slider-img").attr('src', slider_img);
  $("#slider-a").text(slider_a);
  $("#slider-a").attr('href', slider_href);
  $("#slider-p").text(slider_p);
  i++;

  setTimeout(next_post, 8000);
}
