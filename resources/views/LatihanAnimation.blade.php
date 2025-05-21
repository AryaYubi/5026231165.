<!DOCTYPE html>
<html>
<head>


<style>
body {
    background-color: black;
    color: white;
    font-family: sans-serif;
    padding: 2rem;
}

.spinner {
    width: 200px;
    height: 200px;
    border-radius: 100px;
    border: solid blue;
    border-bottom-color: white;
    animation: spin 3s ease-in-out infinite;
    margin: 2rem auto;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
        background-color: white;
    }
    33% {
        transform: rotate(120deg);
    }
    67% {
        transform: rotate(240deg);
    }
    100% {
        transform: rotate(360deg);
        background-color: red;
    }
}
</style>
</head>
<body>
  <h1><span style="color: white">CSS Animation</span></h1>
  <p><span style="color: white">Tes pak</span></p>
  <pre><span style="color: white">Hallo</span></pre>

  <div class="spinner"></div>
</body>

</html>
