<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
   	<span>
   		<a href="index.php">TheBestSite</a>
   	</span>
   	<span>
   		<a href="premium.php">Concours</a>
   	</span>
   	<span>
   		<a href="liste.php">Bibliothèque</a>
   	</span>
    <?php if(!$sessionConnected) { ?>
    <span>
      <a href="register.php">Register</a>
    </span>

    <span>
      <a href="login.php">Login</a>
    </span>
      <span>
      <a href="passForget.php">Mot de passe oublié</a>
    </span>
     <?php } else { ?>
     <span>
      <a href="disconect.php">Se déconnecter</a>
    </span>
    <span>
      <i class="fa fa-check" aria-hidden="true"></i>
    </span>
    <?php } if(!$sessionConnected) { ?>
    <span>
        <i class="fa fa-times" aria-hidden="true"></i>
    </span>
    <?php } ?>

  </div>
</nav>