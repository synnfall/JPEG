<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JPEG - 404</title>
  <style>
    :root {
    --primary : #151922 ;
    --primary100 : #32363E ;
    --primary200 : #505359 ;
    --primary300 : #505359 ;
    --primary400 : #8A8C91 ;

    --secondary : #FFB433 ;
    --secondary100 : #FFBD4D ;
    --secondary200 : #FFC766 ;
    --secondary300 : #FFD080 ;
    --secondary400 : #FFDA99 ;

    --tertiary : #202E46 ;
    --tertiary100 : #3C485D ;
    --tertiary200 : #586274 ;
    --tertiary300 : #747C8B ;
    --tertiary400 : #9096A3 ;

    --accent : #CFCFCF ;
    --succes : #29E330 ;
    --danger : #FD003F ;


    --transition-03 : .3s;
    }

    * {
      all: unset;
    }

    head {
      display: none;
    }

    a {
      cursor: pointer;
    }

    body {
      background-color: var(--primary);
      color: var(--accent);
      font-family: sans-serif;
      font-weight: normal;
      overflow-x: clip;
    }

    h1, h2, h3 {
      font-weight: 600;
      text-decoration: underline;
      text-decoration-thickness: 5px;
      text-decoration-color: var(--secondary);
    }

    h1 {
      font-size: 2em;
    }

    h2 {
      font-size: 1.5em;
    }

    ::selection {
      color: var(--tertiary);
      background-color: var(--accent);
    }
    
    /*ERR404*/
    .err404 {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .err404 h1 {
      font-size: 64px;
      text-decoration-color: var(--danger);
    }

    .err404 h2 {
      text-decoration-color: var(--danger);
    }

    .err404 a {
      margin: 30px;
      padding: 10px 25px;

      font-weight: 900;

      backdrop-filter: blur(5px);

      border: 2px solid var(--danger);
      border-radius: 32px;
      transition: .3s;
    }

    .err404 a:hover {
      background: var(--primary);
      color: var(--danger);
      transition: .3s;
    }

    .gear {
      position: absolute;
      z-index: -100;
      animation: spin 20s linear infinite;
      pointer-events: none;
      user-select: none;

      filter: opacity(.5);
    }

    .gear2 {
      bottom: -700px;
      right: -1000px;
      width: 3000px;
      animation-direction: reverse;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <!-- MAIN -->
  <main>

    <div class="err404">
        <h1>404</h1>
        <h2>Uh Oh, La page que vous avez demandé n'existe pas (encore) !</h2>
        <a href="/">Revenir a l'accueil</a>
    </div>
    
    <img src="./img/gear.svg" alt="gear" class="gear gear2">
  </main>
</body>
</html>
