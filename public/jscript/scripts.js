$(function(){

    var tagSelection = $("#add_tag");
    if (! tagSelection.length){
        return;
    }
    var addTagBtn = $("#add_tag_btn");
    addTagBtn.on('click', function(e){
        e.preventDefault();
        var tagId = tagSelection.val();
        var articleId = tagSelection.attr('data-article');
        attachTagToArticle(tagId, articleId);
    });


    function attachTagToArticle(tagId, articleId){
        $.get(
            "/tags/attach/"+tagId+"/"+articleId,
            {},
            function(data){
                if (data.success == 1){
                    location.reload();
                }
            },
            "json"
        );
    }
})
