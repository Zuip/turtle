let formatDateParts = dateParts => dateParts.map(
  datePart => datePart.replace(/^0+/, '')
).reverse().join('.');

export default function(startDateString, endDateString) {

  let startParts = startDateString.split('-');
  let endParts = endDateString.split('-');

  if(startDateString === endDateString) {
    return formatDateParts(startParts);
  }

  if(startParts[0] === endParts[0]) {

    if(startParts[1] === endParts[1]) {
      startParts.shift();
    }

    startParts.shift();

    startParts[0] += '.';
  }

  return formatDateParts(startParts)
       + '-'
       + formatDateParts(endParts);
};