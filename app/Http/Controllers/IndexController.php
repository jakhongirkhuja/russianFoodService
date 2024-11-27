<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $countries = [
            "Россия",
            "Азербайджан",
            "Армения",
            "Беларусь",
            "Казахстан",
            "Кыргызстан",
            "Молдова",
            "Таджикистан",
            "Туркменистан",
            "Украина",
            "Узбекистан",
            "Албания",
            "Андорра",
            "Австрия",
            "Бельгия",
            "Босния и Герцеговина",
            "Болгария",
            "Хорватия",
            "Кипр",
            "Чехия",
            "Дания",
            "Эстония",
            "Финляндия",
            "Франция",
            "Германия",
            "Греция",
            "Венгрия",
            "Исландия",
            "Ирландия",
            "Италия",
            "Лихтенштейн",
            "Литва",
            "Люксембург",
            "Мальта",
            "Монако",
            "Черногория",
            "Нидерланды",
            "Северная Македония",
            "Норвегия",
            "Польша",
            "Португалия",
            "Румыния",
            "Сан-Марино",
            "Сербия",
            "Словакия",
            "Словения",
            "Испания",
            "Швеция",
            "Швейцария",
            "Турция",
            "Великобритания",
            "Ватикан",
            "Алжир",
            "Ангола",
            "Бенин",
            "Ботсвана",
            "Буркина-Фасо",
            "Бурунди",
            "Камерун",
            "Кабо-Верде",
            "Центральноафриканская Республика",
            "Чад",
            "Коморы",
            "Кот-д'Ивуар",
            "Джибути",
            "Египет",
            "Эритрея",
            "Эсватини",
            "Эфиопия",
            "Габон",
            "Гамбия",
            "Гана",
            "Гвинея",
            "Гвинея-Бисау",
            "Кения",
            "Лесото",
            "Либерия",
            "Ливия",
            "Мадагаскар",
            "Малави",
            "Мали",
            "Мавритания",
            "Маврикий",
            "Марокко",
            "Мозамбик",
            "Намибия",
            "Нигер",
            "Нигерия",
            "Руанда",
            "Сан-Томе и Принсипи",
            "Сенегал",
            "Сейшельские Острова",
            "Сьерра-Леоне",
            "Сомали",
            "Южная Африка",
            "Южный Судан",
            "Судан",
            "Танзания",
            "Того",
            "Тунис",
            "Уганда",
            "Замбия",
            "Зимбабве",
            "Аргентина",
            "Багамские Острова",
            "Барбадос",
            "Боливия",
            "Бразилия",
            "Канада",
            "Чили",
            "Колумбия",
            "Коста-Рика",
            "Куба",
            "Доминика",
            "Доминиканская Республика",
            "Эквадор",
            "Сальвадор",
            "Гренада",
            "Гватемала",
            "Гайана",
            "Гаити",
            "Гондурас",
            "Ямайка",
            "Мексика",
            "Никарагуа",
            "Панама",
            "Парагвай",
            "Перу",
            "Сент-Китс и Невис",
            "Сент-Люсия",
            "Сент-Винсент и Гренадины",
            "Суринам",
            "Тринидад и Тобаго",
            "США",
            "Уругвай",
            "Венесуэла",
            "Австралия",
            "Фиджи",
            "Кирибати",
            "Маршалловы Острова",
            "Микронезия",
            "Науру",
            "Новая Зеландия",
            "Палау",
            "Папуа-Новая Гвинея",
            "Самоа",
            "Соломоновы Острова",
            "Тонга",
            "Тувалу",
            "Вануату",
            "Афганистан",
            "Бахрейн",
            "Бангладеш",
            "Бруней",
            "Камбоджа",
            "Китай",
            "Восточный Тимор",
            "Индия",
            "Индонезия",
            "Иран",
            "Ирак",
            "Израиль",
            "Япония",
            "Иордания",
            "Казахстан",
            "Кувейт",
            "Лаос",
            "Ливан",
            "Малайзия",
            "Мальдивы",
            "Монголия",
            "Мьянма",
            "Непал",
            "Оман",
            "Пакистан",
            "Филиппины",
            "Катар",
            "Саудовская Аравия",
            "Сингапур",
            "Южная Корея",
            "Шри-Ланка",
            "Сирия",
            "Тайвань",
            "Таджикистан",
            "Таиланд",
            "Туркменистан",
            "Объединенные Арабские Эмираты",
            "Узбекистан",
            "Вьетнам",
            "Йемен"
        ];
        foreach ($countries as $key => $country) {
            $newcountry = new Country();
            $newcountry->name = $country;
            $newcountry->save();
        }
        return response()->json(Country::all());
    }
}