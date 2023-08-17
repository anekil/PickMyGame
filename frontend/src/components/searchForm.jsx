export const SearchForm = () => {

    return (
        <>
            <form action="/send-data-here" method="post">
                <label htmlFor="first">First name:</label>
                <input type="text" id="first" name="first" />
                <label htmlFor="last">Last name:</label>
                <input type="text" id="last" name="last" />
                <button type="submit">Submit</button>
                <label for="roll">Roll Number</label>
                <input
                        type="text"
                        id="roll"
                        name="roll"
                        required
                        minlength="10"
                        maxlength="20"
                />
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required />
                <button type="submit">Submit</button>
            </form>
        </>
    );
};
/*
<input type="text"> 	Displays a single-line text input field
    <input type="radio"> 	Displays a radio button (for selecting one of many choices)
        <input type="checkbox"> 	Displays a checkbox (for selecting zero or more of many choices)
            <input type="submit"> 	Displays a submit button (for submitting the form)
                <input type="button"> 	Displays a clickable button
*/