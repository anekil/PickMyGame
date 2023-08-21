import { create } from "zustand"
import {devtools, persist} from "zustand/middleware";


let useParametersStore =
    (set, get) => ({
        title: null,
        players: 2,
        playtime: [10, 20],
        categories: null,
        mechanics: null,
        setTitle : (newValue) => set({title: newValue}),
        setPlayers : (newValue) => set({players: newValue}),
        setPlaytime : (newValue) => set({playtime: newValue}),
        setMechanicsOrCategories : (option, newValue) => {
            if(option === "mechanics")
                set({mechanics: newValue})
            if(option === "categories")
                set({categories: newValue})
        },
        clearStore: () => set({}, true)
})

useParametersStore = devtools(useParametersStore);
useParametersStore = persist(useParametersStore, {name: 'search_params'});
const useParameters = create(useParametersStore);

export default useParameters;