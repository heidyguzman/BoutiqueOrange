document.querySelectorAll('.like-btn').forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    // El siguiente bloque PHP solo se ejecuta en el servidor, así que ignóralo en JS puro
    if (!window.isUserLoggedIn) return;
    var postId = this.getAttribute('data-post-id');
    var button = this;
    fetch('/BOUTIQUEORANGE/controllers/LikeController.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'post_id=' + encodeURIComponent(postId)
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        button.querySelector('.like-count').textContent = data.likes;
        if (data.liked) {
          button.classList.add('liked');
          button.querySelector('svg').setAttribute('fill', 'red');
        } else {
          button.classList.remove('liked');
          button.querySelector('svg').setAttribute('fill', 'none');
        }
      }
    });
  });
});

// Variable global para saber si el usuario está logueado (puedes setearla en PHP)
window.isUserLoggedIn = typeof window.isUserLoggedIn !== 'undefined' ? window.isUserLoggedIn : true;
