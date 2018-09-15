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
    startParts.shift();
    startParts[0] += '.';
  }

  return formatDateParts(startParts)
       + ' - '
       + formatDateParts(endParts);
};