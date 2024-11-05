#include <iostream>
#include <string>
using namespace std;
int main(){
    int nmL, nm, nmP, jurusan, sekolah, alamat, hobi, cita;
    cin >> nmL >> nm >> nmP >> jurusan  >> sekolah >> alamat >> hobi >> cita;
    int identitas[8] = {nmL, nm, nmP, jurusan, sekolah, alamat, hobi, cita};
    cout << identitas[0] << endl;
    return 0;
}