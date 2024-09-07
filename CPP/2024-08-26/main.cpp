#include <iostream>

using namespace std;

int main()
{
    double matematika, fisika, kimia;

    std::cout << "Nilai Matematika :";
    std::cin >> matematika;
    std::cout << "Nilai Fisika :";
    std::cin >> fisika;
    std::cout << "Nilai Kimia :";
    std::cin >> kimia;

    double rata_rata = (matematika + fisika + kimia) / 3;
    cout << rata_rata << endl;

    bool lulus = {rata_rata > 70};

    if (lulus)
    {
        std::cout << "LULUS" << std::endl;
    }
    else
    {
        std::cout << "TIDAK LULUS" << std::endl;
    }
}
