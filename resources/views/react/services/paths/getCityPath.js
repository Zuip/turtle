export default function(country, city, translations) {
  return (
    '/' + translations.routes.countries
    + '/' + country.urlName
    + '/' + translations.routes.cities
    + '/' + city.urlName
  );
}