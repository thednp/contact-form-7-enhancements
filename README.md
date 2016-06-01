# Contact Form 7 Enhancements Plugin
This plugin covers 2 most essential overrides for Contact Form 7 plugin:
* replaces `<input>` with `<button>` HTML tag to allow more customization ver the submit button
* adds placeholder support for quiz field type

# Using the placeholder for quiz
To enable placeholder for the quiz field, simply mention the `placeholder` shortcode setting and it will use your quiz question as placeholder. Example:

```
[quiz capital-quiz class:your-class id:yourQuizName placeholder "The capital of Japan?|Tokyo"]
```
Everything else about quiz is to be managed as described in the [documentation](http://contactform7.com/quiz/).
