function fetch_pair(pair) {
  const request = new XMLHttpRequest();
  request.open('GET', 'https://api.kraken.com/0/public/Ticker?pair=' + pair);

  request.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const response = JSON.parse(this.responseText);

      document.getElementById(pair + '-bid').innerText =
        response['result'][pair]['b'][0];
      document.getElementById(pair + '-ask').innerText =
        response['result'][pair]['a'][0];
    }
  };

  request.send();
}

document.addEventListener('DOMContentLoaded', function (event) {
  fetch_pair('XDGEUR');
  fetch_pair('XXBTZEUR');

  setInterval(function () {
    fetch_pair('XDGEUR');
    fetch_pair('XXBTZEUR');
  }, 30 * 1000);
});
