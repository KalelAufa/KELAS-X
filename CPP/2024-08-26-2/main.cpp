#include <iostream>

using namespace std;

int main()
{
    cout << "KESEMPATAN JADI PACAR KAMU" << endl;
    double goodlooking, perhatian, sultan, sigma, mewing;

    std::cout << "Nilai good looking :";
    std::cin >> goodlooking;
    std::cout << "Nilai perhatian :";
    std::cin >> perhatian;
    std::cout << "Nilai sultan :";
    std::cin >> sultan;
    std::cout << "Nilai sigma :";
    std::cin >> sigma;
    std::cout << "Nilai mewing :";
    std::cin >> mewing;

    double rata_rata = (goodlooking + perhatian + sultan + sigma + mewing) / 5;
    bool lulus = (rata_rata > 75);
    std::cout << "rata-rata :" << rata_rata << std::endl;

    if (lulus)
    {
        std::cout << "DAPAT PACAR" << std::endl;
    }
    else
    {
        std::cout << "TIDAK DAPAT PACAR" << std::endl;
    }
    return 0;
}
