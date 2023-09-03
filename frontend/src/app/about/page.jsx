import {GameData} from "../../components/gameData";

const gameString = "{\n" +
    "        \"name\": \"Tesla vs. Edison: War of Currents\",\n" +
    "        \"min_players\": 2,\n" +
    "        \"max_players\": 5,\n" +
    "        \"min_playtime\": 40,\n" +
    "        \"max_playtime\": 100,\n" +
    "        \"min_age\": 14,\n" +
    "        \"description\": \"You control a start-up company in the early days of the U.S. electric industry. In the beginning you only have your lead inventor, some shares of preferred stock, and some money. Over the course of the game you will be hiring other famous technicians and business people to work for you. Each luminary in the game has their own unique ratings, and the inventors also have their own special abilities.<br />\\r\\n<br />\\r\\nThe actions that you allocate this team of exceptional historical figures to take will determine the fate of your company. There are four focuses in the game: claiming electric projects on the map, advancing up a tech tree, investing in public relations to improve public opinion of your company or the technologies it uses, and buying and selling stock on a dynamic market. You will need to pay attention to all of them but can win the game by specializing in just a specific one or two of your choice, or trying to build a more balanced company. The path you take is up to you.\",\n" +
    "        \"image_url\": \"https://s3-us-west-1.amazonaws.com/5cc.images/games/uploaded/1559255002978-51za2T-kRDL.jpg\",\n" +
    "        \"mechanics\": [\n" +
    "            \"cooperation\",\n" +
    "            \"strategy\"\n" +
    "        ],\n" +
    "        \"categories\": [\n" +
    "            \"cooperation\",\n" +
    "            \"strategy\"\n" +
    "        ],\n" +
    "        \"rules_url\": null,\n" +
    "        \"average_user_rating\": 3.132034632034632\n" +
    "    }";

export default async function Page() {
    return (
        <GameData gameString={gameString}/>
    );
};
