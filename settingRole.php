<?php
function group1()
{
    // 4: id instructor
    return ['4'];
}
function group2()
{
    // 6: id student
    return ['6'];
}
function group3()
{
    // 2: Administrator, 3: Admin, 5: PIC 
    return ['2', '3', '5'];
}
function role_available()
{
    // 4: id instructor, 6: id student
    return ['4', '6'];
}

// in_array
function canAddModul($role)
{
    if (in_array($role, group1())) {
        return true;
    }
}
