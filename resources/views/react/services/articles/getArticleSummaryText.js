export default function(article) {

  let html = document.createElement("div");
  html.innerHTML = article.summary;
  let p = html.querySelector('p');

  if(p) {
    return p.innerHTML;
  }

  return '';
};