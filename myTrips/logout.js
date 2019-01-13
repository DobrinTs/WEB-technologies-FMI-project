var logoutButton = document.getElementById('logoutButton');
logoutButton.addEventListener('click', logout);

function logout() {
  ajax('../server/logout', {
    success: function() {
      window.location.replace('../login')
    },
  })
}
