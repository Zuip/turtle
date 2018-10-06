export default function(description) {
  document.querySelector(
    'meta[name=description]'
  ).content = description;
};