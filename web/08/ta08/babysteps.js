/* 

[ 'C:\\Program Files\\nodejs\\node.exe',
  'C:\\Users\\thesp\\cs313-php\\web\\ta08\\babysteps.js',
  '1',
  '2',
  '3' ]
  
*/

var sum = 0;

for (var i = 2; i < process.argv.length; i++) {
    sum += Number(process.argv[i]);
}

console.log(sum);