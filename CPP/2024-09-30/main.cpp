#include <iostream>
#include <cmath>
using namespace std;

int main(){

    // float radius, area;

    // cout << "Masukkan jari-jari lingkaran : ";
    // cin >> radius;

    // // area = M_PI * radius * radius; 
    // // cout << "Luas lingkaran adalah : " << area << endl;

    // // area = M_PI * radius;
    // // cout << "Keliling lingkaran adalah : " << area << endl;
    

    // float alas, tinggi, area;

    // cout << "Masukkan Alas limas : ";
    // cin >> alas;
    // cout << "Masukkan Tinggi : ";
    // cin >> tinggi;

    // area = alas * tinggi;
    // cout << "Luas Limas Segitiga Adalah : " << area << endl;

    // float num1, num2, num3, average;

    // cout << "Masukkan Tiga angka : ";
    // cin >> num1 >> num2 >> num3;

    // average = (num1 + num2 + num3) / 3;
    // cout << "Rata-rata dari ketiga angka adalah : " << average << endl;

    float celcius, fahrenheit;

    cout << "Masukkan suhu dalam celcius : ";
    cin >> celcius;

    fahrenheit = (celcius * 9 / 5) + 32;
    cout << "Suhu dalam fahrenheit adalah : " << fahrenheit << endl;

    return 0;
}