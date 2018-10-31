import formatVisitDates from '..//trips/visits/formatVisitDates';

export default function(article) {
  return article.city.name + ', '
        + article.city.country.name + ', '
        + getVisitDates(article)
        + ' - Turtle.travel';
}

function getVisitDates(article) {
  return formatVisitDates(
    article.visit.start,
    article.visit.end
  );
}