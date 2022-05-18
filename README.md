# Cloud function triggered by http call 
Google Cloud Function which is a HTTP-Trigger based function. It means that we can directly invoke it via a HTTPs endpoint that will be assigned to our function.

We are going to use this endpoint to send message to our test Slack channel `test-webshop-cf`

Runtime: PHP 7.4

### Steps to run this function
1.  Open GCC by following this link [Google cloud function list](https://console.cloud.google.com/functions/list).
You will see the list already existing functions.
2. Check that you have installed Cloud SDK by running this command in terminal
```
gcloud
```
Check the list installed google cloud command tools
```
gcloud components list
```
If you are not authenticated in GCC then:
```
gcloud auth login
```
3. Clone this repo
```
git clone git@github.com:lemon57/cloud-function-http-trigger-php.git
```
4. Define Slack webhook url in `config.php`. You can find this webhook -> [Slack channel webhook](https://api.slack.com/apps/A03FHHA7URG/incoming-webhooks?).
5. Deploy this function:
```
gcloud functions deploy <FUNC_NAME> --trigger-http \
  --region=<REGION> --runtime=php74
```
Replace `FUNC_NAME` by your own function name.\
Replace `REGION` by correct region name, in our case is `europe-west1`.\

6. Check that the function deployed successfully:
```
gcloud functions describe <FUNC_NAME> --region=<REGION>
``` 
or you can check the list of functions by this command:
```
gcloud functions list | grep <KEY_WORD_FROM_FUNC_NAME>
```
7. Invoke the function by command:
```
gcloud functions call --data '{"message":"Hello from boozt GCF workshop. Created by {your_name}"}' <FUNC_NAME> --region=<REGION>
```
8. Another way to trigger this function:
```
curl -H "Content-Type: application/json" \
 -X POST \
 -d '{"message":"Trigger GCF by curl command. By {your_name}"}' \
 https://<REGION>-<PROJECT_ID>.cloudfunctions.net/<FUNC_NAME>
```
Replace FUNC_NAME by name of our php function.\
Replace REGION by current region in GCC project.\
Replace PROJECT_ID by name of our project in GCC.\ 
You can always check details about current project by this command:
```
gcloud config list
```
and then get more details about your project
```
gcloud projects describe <PROJECT_ID>
```
9. Check the logs:
```
gcloud functions logs read --execution-id=<EXECUTION_ID> --region=<REGION_NAME>
```
Take `EXECUTION_ID` from the output after executing the command: `gcloud functions call`.

10. Check slack channel `test-webshop-cf` 

Play with other different parameters for `gcloud` command or chack the same functionality in GCC UI.

 :rocket: google :cloud:
