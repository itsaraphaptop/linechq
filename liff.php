
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LIFF - LINE Front-end Framework</title>
  <!-- <style>
    body { margin: 16px }
    button, img { display: none; width: 40% }
    button { padding: 16px }
  </style> -->
</head>
<body>
  <h1>Page 2</h1>
  <img id="pictureUrl">
  <button id="btnLogIn" onclick="logIn()">Log In</button>
  <button id="btnLogOut" onclick="logOut()">Log Out</button>
  <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
  <script>
    function logOut() {
      liff.logout()
      window.location.reload()
    }
    function logIn() {
      liff.login({ redirectUri: window.location.href })
    }
    async function getUserProfile() {
      const profile = await liff.getProfile()
      document.getElementById("pictureUrl").style.display = "block"
      document.getElementById("pictureUrl").src = profile.pictureUrl
    }
    async function main() {
      await liff.init({ liffId: "1657918882-APvn35n7", withLoginOnExternalBrowser: true})
    //   if (liff.isInClient()) {
    //     getUserProfile()
    //   } else {
    //     if (liff.isLoggedIn()) {
    //       getUserProfile()
    //     //   document.getElementById("btnLogIn").style.display = "none"
    //     //   document.getElementById("btnLogOut").style.display = "block"
    //     } else {
    //     //   document.getElementById("btnLogIn").style.display = "block"
    //     //   document.getElementById("btnLogOut").style.display = "none"
    //     }
    //   }
    if (liff.isLoggedIn()) {
        getUserProfile()
       window.location.href = "https://web.facebook.com/220030325398357/posts/1172701903464523/"
      } 
    }
    main()
  </script>
</body>
</html>
view rawliff-login.html hosted with ❤ by GitHub