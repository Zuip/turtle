export default function(country, translations) {
  return (
    '/' + translations.routes.countries
    + '/' + country.urlName
  );
}