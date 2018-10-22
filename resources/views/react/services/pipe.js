const _pipe = (a, b) => (arg) => b(a(arg));
export default (...ops) => ops.reduce(_pipe);
