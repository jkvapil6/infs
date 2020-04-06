function getAjaxContent() {
  $(document).ready(function () {
    $(".whisperer").fadeIn(100);
    var searchedText = $(".search-input").val();
    console.log("changing content");
    $(".whisperer").load("model/loadWhisper.php", {
      newSearchedText : searchedText
    });
  });
}

$(window).click(function() {
  $(".whisperer").fadeOut(100);
});

function setSearchedContent(id) {
  console.log("selecting li" + id);
  var text = $("#li-" + id).text();
  $(".search-input").val(text);
}
