export default function(title, baseFirst) {

  let base = 'Turtle.travel';

  if(typeof title === 'undefined') {
    document.title = base;
    return;
  }

  if(baseFirst) {
    document.title = base + ': ' + title;
    return;  
  }

  document.title = title + ' - ' + base;
};