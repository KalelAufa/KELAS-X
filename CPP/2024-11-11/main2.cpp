#include <iostream>
#include <string>
using namespace std;

struct Siswa{
    string nama, namaPanggilan, jurusan, sekolah, alamat, hobi, cita;
};
int main(){
    Siswa siswa[38];
    for (int i = 1; i <= 2; i++)
    {
        cout << "Data Siswa ke " << i << endl;
        cout << "Nama Lengkap : ";
        cin >> siswa[i].nama;
        cout << "Nama Panggilan : ";
        cin >> siswa[i].namaPanggilan;
        cout << "Jurusan : ";
        cin >> siswa[i].jurusan;
        cout << "Sekolah : ";
        cin >> siswa[i].sekolah;
        cout << "Alamat : ";
        cin >> siswa[i].alamat;
        cout << "Hobi : ";
        cin >> siswa[i].hobi;
        cout << "Cita-Cita : ";
        cin >> siswa[i].cita;
        cout << endl;
    }
    for (int i = 1; i <= 2; i++)
    {
        cout << "Data Siswa ke " << i << endl;
        cout << "Nama Lengkap : " << siswa[i].nama << endl;
        cout << "Nama Panggilan : " << siswa[i].namaPanggilan << endl;
        cout << "Jurusan : " << siswa[i].jurusan << endl;
        cout << "Sekolah : " << siswa[i].sekolah << endl;
        cout << "Alamat : " << siswa[i].alamat << endl;
        cout << "Hobi : " << siswa[i].hobi << endl;
        cout << "Cita-Cita : " << siswa[i].cita << endl;
        cout << endl;
    }
    
    return 0;
}