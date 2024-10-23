#include <iostream>
using namespace std;
int main() {
    int n;
    do
    {
        cout << "Masukkan Nilai: ";
        cin >> n;
            if (n >= 80)
            {
                cout << "Nilai A" << endl;
            }
            else if (n >= 70)
            {
                if (n >= 75)
                {
                    cout << "Nilai B+" << endl;
                }
                else
                {
                    cout << "Nilai B" << endl;
                }
            }
            else
            {
                cout << "Nilai C" << endl;
            }
    } while (n != 0);
        cout << " " << endl;
    return 0;
}