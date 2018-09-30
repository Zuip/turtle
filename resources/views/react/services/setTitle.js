export default function(title) {

  let base = 'Turtle.travel';

  if(typeof title === 'undefined') {
    document.title = base;
    return;
  }

  document.title = base + ' - ' + title;
};