#include <iostream>

int main()
{
    int array[700];

    for (int i = 0; i <= 700; ++i)
    {
        array[i] = i + 2;
    }

    for (int i = 0; i <= 699; ++i)
    {
        std::cout << "Array [" << i << "] = " << array[i] << std::endl;
    }

    return 0;
}


