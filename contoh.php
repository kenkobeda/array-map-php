<?php

/*
Fungsi array_map() digunakan untuk memodifikasi setiap elemen dalam sebuah array menggunakan fungsi yang diberikan, dan mengembalikan array baru yang berisi hasil modifikasi.

Format umum dari array_map() adalah sebagai berikut:
*/
array_map(callable $callback, array $array1, array ...$array2): array
/*

$callback: fungsi yang akan diaplikasikan pada setiap elemen array.
$array1, $array2, dan seterusnya: array yang akan dimodifikasi.
array_map() akan mengembalikan array yang dihasilkan setelah memodifikasi setiap elemen array.
Contoh penggunaan array_map() untuk mengalikan setiap elemen array dengan faktor 2 adalah sebagai berikut:
 */

$array = [1, 2, 3, 4, 5];
$mapped_array = array_map(function($n) { return $n * 2; }, $array);

print_r($mapped_array);

// Output dari kode di atas adalah:
/* 
Array
(
    [0] => 2
    [1] => 4
    [2] => 6
    [3] => 8
    [4] => 10
)
callable $callback adalah parameter pada fungsi array_map() yang diharapkan berupa fungsi yang dapat dipanggil. Dalam PHP, fungsi dapat didefinisikan dengan kata kunci function, atau dapat diwakili oleh objek callable, seperti objek Closure.

Contoh penggunaan fungsi array_map() dengan fungsi biasa dan fungsi anonim adalah sebagai berikut:

*/

// Fungsi biasa
function multiply($n) {
    return $n * 2;
}

$array = [1, 2, 3, 4, 5];

$mapped_array = array_map("multiply", $array);
print_r($mapped_array);

// Fungsi anonim
$array = [1, 2, 3, 4, 5];

$mapped_array = array_map(function($n) { return $n * 2; }, $array);
print_r($mapped_array);

//Output dari kode di atas adalah sama, yaitu:
/* 
Array
(
    [0] => 2
    [1] => 4
    [2] => 6
    [3] => 8
    [4] => 10
)

kenapa pada contoh pertama, fungsi multiply() di panggil dalam array_map() menggunakan string?

Pada contoh pertama, array_map() memanggil fungsi multiply() dengan menggunakan string "multiply" sebagai argumen pertama. Ini karena argumen pertama dari array_map() diharapkan berupa callable, yaitu referensi ke fungsi atau objek yang dapat dipanggil.

Pada PHP, callable dapat berupa tiga jenis, yaitu:

1. Nama fungsi sebagai string: 'fungsi'
2. Fungsi anonim: function() { ... }
3. Objek Closure

Dalam contoh pertama, multiply() adalah sebuah fungsi yang dapat dipanggil dan didefinisikan sebagai nama fungsi. Oleh karena itu, kita dapat menggunakan string "multiply" sebagai callable untuk memanggil fungsi tersebut melalui array_map(). Hal ini berbeda dengan fungsi anonim yang harus langsung didefinisikan di dalam array_map() atau menggunakan objek Closure jika ingin dijadikan callable.


lalu bagaimana dengan contoh Objek Closure???

Objek Closure adalah salah satu jenis callable pada PHP. Objek Closure dapat digunakan untuk merepresentasikan fungsi yang dapat disimpan dalam variabel dan dipanggil secara dinamis.

Berikut adalah contoh penggunaan objek Closure dalam array_map():
*/

// Menggunakan objek Closure
$array = [1, 2, 3, 4, 5];
$multiplier = 2;
$multiply = function($n) use ($multiplier) { return $n * $multiplier; };
$mapped_array = array_map($multiply, $array);
print_r($mapped_array);

/* 
Dalam contoh di atas, kita membuat sebuah objek Closure yang merepresentasikan fungsi multiply(). Objek Closure tersebut disimpan dalam variabel $multiply dan memiliki variabel $multiplier sebagai parameter. Variabel $multiplier didefinisikan di luar objek Closure dan digunakan di dalamnya menggunakan kata kunci use. Kemudian, objek Closure tersebut dipanggil melalui array_map() dan diaplikasikan pada setiap elemen dalam array $array.


Output dari kode di atas adalah sebagai berikut:

Array
(
    [0] => 2
    [1] => 4
    [2] => 6
    [3] => 8
    [4] => 10
)

Dalam contoh di atas, kita bisa melihat bahwa penggunaan objek Closure dalam array_map() mirip dengan penggunaan fungsi anonim, namun dengan kemampuan untuk menyimpan variabel di luar fungsi tersebut.
*/


/* 
di PHP kita bisa menggunakan fungsi array_map() untuk melakukan operasi pada setiap elemen array sesuai dengan spesifikasi yang kita inginkan. Kita bisa menggunakan sebuah fungsi atau sebuah objek Closure untuk mengatur logika operasi pada setiap elemen array.

Sebagai contoh, jika kita ingin mengalikan nilai setiap elemen array dengan nilai yang berbeda-beda, seperti index pertama dikalikan dengan 2, index kedua dikalikan dengan 4, index ketiga dikalikan dengan 6, dan seterusnya, kita bisa menggunakan objek Closure untuk melakukan operasi tersebut, seperti ini:

*/

$array = [1, 2, 3, 4, 5];
$mapped_array = array_map(function($value, $index) {
    return $value * (($index + 1) * 2);
}, $array, array_keys($array));
print_r($mapped_array);

// atau bisa juga

$array = [1, 2, 3, 4, 5];
$multiplier = 2;
$multiply = function($a, $b) use ($multiplier) {
    return $a * (($b+1)* $multiplier);
};
$mapped_array = array_map($multiply,$array,array_keys($array);
print_r($mapped_array);


/*

Pada contoh di atas, kita membuat sebuah objek Closure yang melakukan operasi pada setiap elemen array. Objek Closure ini menerima dua parameter, yaitu $value dan $index. Variabel $value merepresentasikan nilai dari setiap elemen array, dan variabel $index merepresentasikan indeks dari setiap elemen array.

Dalam objek Closure tersebut, kita mengalikan nilai setiap elemen array dengan (($index + 1) * 2), sehingga nilai setiap elemen array akan dikalikan dengan nilai yang berbeda-beda sesuai dengan indeksnya. Untuk mendapatkan indeks dari setiap elemen array, kita menggunakan fungsi array_keys() untuk mendapatkan array yang berisi indeks-indeks dari setiap elemen array.

Output dari kode di atas adalah sebagai berikut:

Array
(
    [0] => 2
    [1] => 8
    [2] => 18
    [3] => 32
    [4] => 50
)

jika function(array, array) dengan dua argumen, maka array_map() setelah callback, juga menggunakan dua argumen menjadi:
array_map(callback, array, array)
*/

/*
`use` adalah salah satu fitur pada PHP yang memungkinkan Anda untuk menggunakan variabel dari luar fungsi atau metode dalam closure. Dalam contoh yang Anda berikan, use ($multiplier) mengambil nilai `$multiplier` dari lingkup yang lebih tinggi (dalam kasus ini, nilai yang didefinisikan di luar fungsi) dan memasukkannya ke dalam closure. Ini memungkinkan closure untuk menggunakan nilai tersebut bahkan ketika variabel itu tidak tersedia dalam lingkup fungsi itu sendiri.

Sebagai contoh, dalam kode berikut:

*/

$multiplier = 2;

$multiply = function($n) use ($multiplier) {
    return $n * $multiplier;
};

echo $multiply(5); // Output: 10

/*

Closure `$multiply` mengambil nilai `$multiplier` dari lingkup yang lebih tinggi dan menggunakannya untuk mengalikan argumen yang diberikan. Dalam kasus ini, argumen adalah `5`, sehingga hasilnya adalah `10`.
*/

/*

array_keys() adalah sebuah fungsi pada PHP yang digunakan untuk mengambil semua kunci dari sebuah array. Fungsi ini mengambil satu argumen wajib, yaitu array asosiatif yang ingin diambil kunci-kuncinya, dan dua argumen opsional.

Berikut adalah sintaks dari fungsi array_keys() beserta argumen-argumennya:
*/
array_keys(array $array, mixed $search_value = null, bool $strict = false): array

/*

-$array (wajib) - Array asosiatif yang ingin diambil kunci-kuncinya.
-$search_value (opsional) - Nilai yang ingin dicari dalam array.
-$strict (opsional) - Menentukan apakah pencarian nilai dilakukan secara ketat (strict) atau tidak.

Fungsi ini mengembalikan sebuah array numerik yang berisi semua kunci dari array yang diberikan. Jika argumen opsional $search_value diberikan, maka fungsi hanya akan mengambil kunci dari nilai yang sama dengan nilai tersebut. Jika argumen opsional $strict diset sebagai true, maka fungsi akan melakukan pencarian secara ketat sehingga tipe data harus sama.

Berikut adalah contoh penggunaan fungsi array_keys():
*/
$fruits = array(
    'apple' => 'apel',
    'banana' => 'pisang',
    'cherry' => 'ceri'
);

// Mengambil semua kunci dari array $fruits
$keys = array_keys($fruits);

print_r($keys);
// Output: Array ( [0] => apple [1] => banana [2] => cherry )

// Mengambil semua kunci dari array $fruits yang memiliki nilai 'apel'
$keys = array_keys($fruits, 'apel');

print_r($keys);
// Output: Array ( [0] => apple )

// Mengambil semua kunci dari array $fruits yang memiliki nilai 'apel' secara ketat
$keys = array_keys($fruits, 'apel', true);

print_r($keys);
// Output: Array ( [0] => apple )

/*
Pada contoh di atas, fungsi array_keys() digunakan untuk mengambil semua kunci dari array $fruits. Kemudian, fungsi tersebut juga digunakan untuk mengambil semua kunci dari array $fruits yang memiliki nilai 'apel'. Terakhir, fungsi digunakan untuk mengambil semua kunci dari array $fruits yang memiliki nilai 'apel' secara ketat*/