const voteContainers = document.querySelectorAll(".js-vote-container");

voteContainers.forEach(function(voteContainer)
{
    const upVoteBtn = voteContainer.querySelector("a.js-upvote");
    upVoteBtn.addEventListener("click", onClickVote);

    const downVoteBtn = voteContainer.querySelector("a.js-downvote");
    downVoteBtn.addEventListener("click", onClickVote);

});

function onClickVote(e) {
    e.preventDefault();

    voteContainer = this.parentNode.parentNode;

    upVote = voteContainer.querySelector('a.js-upvote');
    downVote = voteContainer.querySelector('a.js-downvote');

    upVoteCount = voteContainer.querySelector('span.js-upvotecount');
    downVoteCount = voteContainer.querySelector('span.js-downvotecount');

    const url = this.href;

    axios.get(url).then(function(response) {
        oldVote = response.data.oldvote;
        newVote = response.data.newvote;

        /*
         alert("Old vote: " + oldVote + " | New vote: " + newVote);
         alert("Upvote count : " + response.data.upvotecount +
         " | Downvote count: " + response.data.downvotecount);
         */

        upVoteCount.textContent = response.data.upvotecount

        downVoteCount.textContent = response.data.downvotecount

        if(newVote == 1)
        {
            upVote.classList.replace('fa-thumbs-o-up', 'fa-thumbs-up');
            downVote.classList.replace('fa-thumbs-down', 'fa-thumbs-o-down');
        }
        else
        if(newVote == -1)
        {
            upVote.classList.replace('fa-thumbs-up', 'fa-thumbs-o-up');
            downVote.classList.replace('fa-thumbs-o-down', 'fa-thumbs-down');
        }
        else
        {
            upVote.classList.replace('fa-thumbs-up', 'fa-thumbs-o-up');
            downVote.classList.replace('fa-thumbs-down', 'fa-thumbs-o-down');
        }
    });
}